const searchInput = document.getElementById("search-input");
const autocompleteList = document.getElementById("autocomplete-list");
const form = document.getElementById("plant-search-form");
const spinner = document.getElementById("loading-spinner");
const results = document.getElementById("search-results");

// Debounce helper
function debounce(fn, delay) {
    let timeoutId;
    return function (...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
}

// Highlight matching query in text
function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, "gi");
    return text.replace(regex, "<strong>$1</strong>");
}

// Fetch and render autocomplete suggestions
const fetchSuggestions = debounce(function () {
    const query = searchInput.value.trim();
    if (query.length < 2) {
        autocompleteList.innerHTML = "";
        autocompleteList.style.display = "none";
        return;
    }

    fetch(`${window.routes.autocomplete}?q=${encodeURIComponent(query)}`)
        .then((response) => response.json())
        .then((data) => {
            autocompleteList.innerHTML = "";
            if (data.length === 0) {
                autocompleteList.style.display = "none";
                return;
            }

            data.forEach((plant) => {
                const item = document.createElement("li");
                item.classList.add(
                    "list-group-item",
                    "autocomplete-item",
                    "border-0"
                );
                item.innerHTML = `
                    <div class="d-flex flex-column">
                        <span class="fw-medium">${highlightMatch(
                            plant.local,
                            query
                        )}</span>
                        <small class="text-muted fst-italic">${highlightMatch(
                            plant.latin,
                            query
                        )}</small>
                    </div>
                `;
                item.onclick = () => {
                    searchInput.value = plant.local;
                    autocompleteList.innerHTML = "";
                    form.dispatchEvent(new Event("submit"));
                };
                autocompleteList.appendChild(item);
            });

            autocompleteList.style.display = "block";
        })
        .catch((err) => {
            console.error("Autocomplete fetch failed:", err);
            autocompleteList.style.display = "none";
        });
}, 300);

searchInput.addEventListener("input", fetchSuggestions);

// Hide suggestions when clicking outside
document.addEventListener("click", function (e) {
    if (!autocompleteList.contains(e.target) && e.target !== searchInput) {
        autocompleteList.innerHTML = "";
        autocompleteList.style.display = "none";
    }
});

// AJAX form submit
form.addEventListener("submit", function (e) {
    const query = new URLSearchParams(new FormData(form)).toString();

    spinner.classList.remove("d-none");
    results.innerHTML = "";

    fetch(`${window.routes.search}?${query}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => res.text())
        .then((html) => {
            spinner.classList.add("d-none");
            results.innerHTML = html;
        })
        .catch(() => {
            spinner.classList.add("d-none");
            results.innerHTML =
                '<p class="text-danger text-center">Terjadi kesalahan saat memuat hasil.</p>';
        });
});

// Tab nav behavior
document.querySelectorAll(".google-nav button").forEach((button) => {
    button.addEventListener("click", () => {
        document
            .querySelectorAll(".google-nav button")
            .forEach((b) => b.classList.remove("active"));

        document
            .querySelectorAll(".tab-pane")
            .forEach((pane) => pane.classList.remove("show", "active"));

        button.classList.add("active");
        const target = document.querySelector(button.dataset.bsTarget);
        target.classList.add("show", "active");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const plant = window.plantData || {};
    let mapMobile, mapDesktop;
    let mapMobileInitialized = false;
    let mapDesktopInitialized = false;

    function initMapMobile() {
        if (mapMobileInitialized) return;
        mapMobileInitialized = true;

        const lat = plant.lat;
        const lng = plant.lng;

        const container = document.getElementById("plant-map-tab");
        if (!container) return;

        if (lat && lng) {
            mapMobile = L.map("plant-map-tab").setView([lat, lng], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(mapMobile);

            L.marker([lat, lng])
                .addTo(mapMobile)
                .bindPopup(plant.name || "")
                .openPopup();
        } else {
            container.innerHTML =
                '<p class="text-muted text-center">Koordinat tidak tersedia.</p>';
        }
    }

    function initMapDesktop() {
        if (mapDesktopInitialized) return;
        mapDesktopInitialized = true;

        const lat = plant.lat;
        const lng = plant.lng;

        const container = document.getElementById("plant-map-desktop");
        if (!container) return;

        if (lat && lng) {
            mapDesktop = L.map("plant-map-desktop").setView([lat, lng], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(mapDesktop);

            L.marker([lat, lng])
                .addTo(mapDesktop)
                .bindPopup(plant.name || "")
                .openPopup();
        } else {
            container.innerHTML =
                '<p class="text-muted text-center">Koordinat tidak tersedia.</p>';
        }
    }

    // Cek viewport untuk load map yang sesuai
    function initMapsByViewport() {
        if (window.innerWidth >= 768) {
            // Desktop
            initMapDesktop();
        } else {
            // Mobile (pakai tab)
            // Init map saat tab lokasi aktif
            if (
                document
                    .getElementById("location-tab-pane")
                    .classList.contains("show")
            ) {
                initMapMobile();
            }

            // Event bootstrap tab untuk mobile
            const locationTabBtn = document.getElementById("location-tab");
            locationTabBtn.addEventListener("shown.bs.tab", function () {
                initMapMobile();
            });
        }
    }

    initMapsByViewport();

    // Optional: re-init peta saat resize (bisa dioptimasi kalau mau)
    window.addEventListener("resize", function () {
        initMapsByViewport();
    });
});
