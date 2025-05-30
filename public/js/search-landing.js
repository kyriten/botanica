const searchInput = document.getElementById("search-input");
const autocompleteList = document.getElementById("autocomplete-list");
const form = document.getElementById("plant-search-form");
const spinner = document.getElementById("loading-spinner");
const results = document.getElementById("search-results");

const MAX_HISTORY = 50;
const STORAGE_KEY = "plantSearchHistory";

function debounce(fn, delay) {
    let timeoutId;
    return function (...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
}

function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, "gi");
    return text.replace(regex, "<strong>$1</strong>");
}

function saveSearchToHistory(keyword) {
    if (!keyword) return;

    let history = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    history = history.filter(
        (item) => item.toLowerCase() !== keyword.toLowerCase()
    );
    history.unshift(keyword);
    if (history.length > MAX_HISTORY) history = history.slice(0, MAX_HISTORY);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(history));
}

function showSearchHistory() {
    const query = searchInput.value.trim();
    if (query.length >= 2) return;

    const history = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    if (history.length === 0) {
        autocompleteList.innerHTML = "";
        autocompleteList.style.display = "none";
        return;
    }

    autocompleteList.innerHTML = "";
    history.forEach((item) => {
        const li = document.createElement("li");
        li.classList.add("list-group-item", "autocomplete-item", "border-0");
        li.innerHTML = `
            <div class="d-flex text-start align-items-center">
                <i class="bi bi-clock-history me-2 text-muted"></i>
                <span>${item}</span>
            </div>
        `;
        li.onclick = () => {
            searchInput.value = item;
            autocompleteList.innerHTML = "";
            form.submit();
        };
        autocompleteList.appendChild(li);
    });

    autocompleteList.style.display = "block";
}

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
                    <div class="d-flex flex-column flex-md-row text-start">
                        <i class="bi bi-search me-2 text-muted"></i>
                        <span class="fw-medium me-2">${highlightMatch(
                            plant.local,
                            query
                        )}</span>
                        <span class="text-muted fst-italic">${highlightMatch(
                            plant.latin,
                            query
                        )}</span>
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

searchInput.addEventListener("focus", showSearchHistory);

document.addEventListener("click", function (e) {
    if (!autocompleteList.contains(e.target) && e.target !== searchInput) {
        autocompleteList.innerHTML = "";
        autocompleteList.style.display = "none";
    }
});

form.addEventListener("submit", function (e) {
    const queryValue = searchInput.value.trim();
    if (queryValue) {
        saveSearchToHistory(queryValue);
    }

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

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-description").forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const container = this.closest(".description-container");
            const shortDesc = container.querySelector(".short-description");
            const fullDesc = container.querySelector(".full-description");

            if (fullDesc.classList.contains("d-none")) {
                shortDesc.classList.add("d-none");
                fullDesc.classList.remove("d-none");
                this.textContent = "Sembunyikan";
            } else {
                fullDesc.classList.add("d-none");
                shortDesc.classList.remove("d-none");
                this.textContent = "Lihat Selengkapnya";
            }
        });
    });
});

document.addEventListener("click", function (e) {
    const target = e.target.closest("[data-value]");
    if (!target) return;

    e.preventDefault();
    const value = target.getAttribute("data-value");

    const parentDropdown = target.closest(".dropdown-menu");
    if (!parentDropdown) return;

    const triggerId = parentDropdown.getAttribute("aria-labelledby");

    if (triggerId === "filterDropdown") {
        const categoryInput = document.getElementById("category-input");
        const form = document.getElementById("plant-search-form");
        if (categoryInput && form) {
            categoryInput.value = value;
            form.submit();
        }
    } else if (triggerId === "gardenDropdown") {
        const gardenBtn = document.getElementById("gardenDropdown");

        // Dapatkan base URL & list URL
        const baseUrl = gardenBtn?.getAttribute("data-base-url");
        const listUrl = gardenBtn?.getAttribute("data-list-url");

        if (value === "") {
            if (listUrl) {
                window.location.href = listUrl;
            }
        } else {
            if (baseUrl) {
                window.location.href = `${baseUrl}/${value}`;
            }
        }
    }
});
