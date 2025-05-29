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
                    <div class="d-flex flex-column text-start">
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
                    form.submit();
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



function loadTabPage(url, tab) {
    const spinner = document.getElementById("loading-spinner");

    // Mapping tab ke container hasil pencarian
    const containerIds = {
        all: "search-results-all",
        image: "search-results-image",
    };

    const containerId = containerIds[tab];
    if (!containerId) {
        console.error("Unknown tab:", tab);
        return;
    }

    const resultsContainer = document.getElementById(containerId);

    if (!resultsContainer) {
        console.error("Container not found for tab:", tab);
        return;
    }

    spinner.classList.remove("d-none");

    const fetchUrl = url.includes("?")
        ? `${url}&tab=${tab}`
        : `${url}?tab=${tab}`;

    fetch(fetchUrl, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((response) => response.text())
        .then((html) => {
            resultsContainer.innerHTML = html;
            spinner.classList.add("d-none");
        })
        .catch((error) => {
            console.error("Error fetching pagination:", error);
            spinner.classList.add("d-none");
        });
}
