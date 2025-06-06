document.getElementById("namaLokal").addEventListener("input", updateSlug);
document.getElementById("namaLatin").addEventListener("input", updateSlug);
document.getElementById("editLocal").addEventListener("input", editUpdateSlug);
document.getElementById("editLatin").addEventListener("input", editUpdateSlug);

function updateSlug() {
    const lokal = document.getElementById("namaLokal").value;
    const latin = document.getElementById("namaLatin").value;

    const slug = slugify(`${lokal} ${latin}`);
    document.getElementById("slug").value = slug;
}

function editUpdateSlug() {
    const editLokal = document.getElementById("editLocal").value;
    const editLatin = document.getElementById("editLatin").value;

    const editSlug = slugify(`${editLokal} ${editLatin}`);
    document.getElementById("editSlug").value = editSlug;
}

// UPPERCASE untuk Nama Lokal
document.getElementById("namaLokal").addEventListener("input", function () {
    this.value = this.value.toUpperCase();
});

document.getElementById("editLocal").addEventListener("input", function () {
    this.value = this.value.toUpperCase();
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("map-form");
    const url = form.dataset.url;
    const token = form.dataset.token;

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                body: formData,
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || "Terjadi kesalahan");
            }

            document.getElementById("alert-container").innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data berhasil disimpan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;

            form.reset();
        } catch (error) {
            console.error(error);
            document.getElementById("alert-container").innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${error.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
        }
    });
});

document.getElementById("search-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const query = new URLSearchParams(new FormData(this)).toString();
    fetchTableData(`{{ route('map.index') }}?${query}`);
});

document.addEventListener("click", function (e) {
    if (e.target.closest(".pagination a")) {
        e.preventDefault();
        fetchTableData(e.target.closest("a").href);
    }
});

function fetchTableData(url) {
    fetch(url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => res.text())
        .then((html) => {
            document.getElementById("data-table-container").innerHTML = html;
        })
        .catch((err) => console.error("Error:", err));
}

$(document).ready(function () {
    $("#inputSpotModal").on("shown.bs.modal", function () {
        $("#selectCity").select2({
            dropdownParent: $("#inputSpotModal"),
            placeholder: $("#selectCity").data("placeholder"),
            allowClear: true,
            width: "100%",
        });
    });

    $("#selectCity").on("change", function () {
        let provinceName = $(this).find(":selected").data("province") || "";
        $("#selectProvince").val(provinceName);
    });
});

$(document).ready(function () {
    $("#editSpotModal").on("shown.bs.modal", function () {
        $("#editCityName").select2({
            dropdownParent: $("#editSpotModal"),
            placeholder: $("#editCityName").data("placeholder"),
            allowClear: true,
            width: "100%",
        });
    });

    $("#editCityName").on("change", function () {
        let provinceName = $(this).find(":selected").data("province") || "";
        $("#editProvinceName").val(provinceName);
    });
});

var collapsePersebaranElement = document.getElementById("collapsePersebaran");
var collapseDetailElement = document.getElementById("collapseDetail");
var collapsePersebaranEditElement = document.getElementById(
    "collapsePersebaranEdit"
);
var collapseDetailEditElement = document.getElementById("collapseDetailEdit");
var arrowPersebaranIcon = document.getElementById("arrowPersebaranIcon");
var arrowDetailIcon = document.getElementById("arrowDetailIcon");
var arrowPersebaranIconEdit = document.getElementById(
    "arrowPersebaranIconEdit"
);
var arrowDetailIconEdit = document.getElementById("arrowDetailIconEdit");
var toggleCollapseDetail = document.getElementById("toggleCollapseDetail");
var toggleCollapseDetailEdit = document.getElementById(
    "toggleCollapseDetailEdit"
);
var toggleCollapsePersebaran = document.getElementById(
    "toggleCollapsePersebaran"
);
var toggleCollapsePersebaranEdit = document.getElementById(
    "toggleCollapsePersebaranEdit"
);

// Event listener untuk membuka atau menutup collapse
toggleCollapsePersebaran.addEventListener("click", function () {
    var bootstrapCollapse = new bootstrap.Collapse(collapsePersebaranElement, {
        toggle: true,
    });
});

toggleCollapsePersebaranEdit.addEventListener("click", function () {
    var bootstrapCollapse = new bootstrap.Collapse(
        collapsePersebaranEditElement,
        {
            toggle: true,
        }
    );
});

toggleCollapseDetail.addEventListener("click", function () {
    var bootstrapCollapse = new bootstrap.Collapse(collapseDetailElement, {
        toggle: true,
    });
});

toggleCollapseDetailEdit.addEventListener("click", function () {
    var bootstrapCollapse = new bootstrap.Collapse(collapseDetailEditElement, {
        toggle: true,
    });
});

// Event listener untuk ketika collapse selesai terbuka
collapsePersebaranElement.addEventListener("shown.bs.collapse", function () {
    // Ganti ikon panah ke atas
    arrowPersebaranIcon.classList.remove("bi-caret-down-fill");
    arrowPersebaranIcon.classList.add("bi-caret-up-fill");
});

// Event listener untuk ketika collapse selesai tertutup
collapsePersebaranElement.addEventListener("hidden.bs.collapse", function () {
    // Ganti ikon panah ke bawah
    arrowPersebaranIcon.classList.remove("bi-caret-up-fill");
    arrowPersebaranIcon.classList.add("bi-caret-down-fill");
});

// Event listener untuk ketika collapse selesai terbuka
collapseDetailElement.addEventListener("shown.bs.collapse", function () {
    // Ganti ikon panah ke atas
    arrowDetailIcon.classList.remove("bi-caret-down-fill");
    arrowDetailIcon.classList.add("bi-caret-up-fill");
});

// Event listener untuk ketika collapse selesai tertutup
collapseDetailElement.addEventListener("hidden.bs.collapse", function () {
    // Ganti ikon panah ke bawah
    arrowDetailIcon.classList.remove("bi-caret-up-fill");
    arrowDetailIcon.classList.add("bi-caret-down-fill");
});

// Event listener untuk ketika collapse selesai terbuka
collapsePersebaranEditElement.addEventListener(
    "shown.bs.collapse",
    function () {
        // Ganti ikon panah ke atas
        arrowPersebaranIconEdit.classList.remove("bi-caret-down-fill");
        arrowPersebaranIconEdit.classList.add("bi-caret-up-fill");
    }
);

// Event listener untuk ketika collapse selesai tertutup
collapsePersebaranEditElement.addEventListener(
    "hidden.bs.collapse",
    function () {
        // Ganti ikon panah ke bawah
        arrowPersebaranIconEdit.classList.remove("bi-caret-up-fill");
        arrowPersebaranIconEdit.classList.add("bi-caret-down-fill");
    }
);

// Event listener untuk ketika collapse selesai terbuka
collapseDetailEditElement.addEventListener("shown.bs.collapse", function () {
    // Ganti ikon panah ke atas
    arrowDetailIconEdit.classList.remove("bi-caret-down-fill");
    arrowDetailIconEdit.classList.add("bi-caret-up-fill");
});

// Event listener untuk ketika collapse selesai tertutup
collapseDetailEditElement.addEventListener("hidden.bs.collapse", function () {
    // Ganti ikon panah ke bawah
    arrowDetailIconEdit.classList.remove("bi-caret-up-fill");
    arrowDetailIconEdit.classList.add("bi-caret-down-fill");
});

// Modal Update Data Listener
document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    function populateEditForm(data, spotId) {
        document.getElementById("selectedGardenIdEdit").value = data.garden_id;
        document.getElementById("editProvinceName").value = data.province_name;
        document.getElementById("editCityName").value = data.city_name;
        document.getElementById("editCategory").value = data.category;
        document.getElementById("editLocal").value = data.local;
        document.getElementById("editLatin").value = data.latin;
        document.getElementById("editSlug").value = data.slug;
        document.getElementById("editKingdom").value = data.kingdom;
        document.getElementById("editSubkingdom").value = data.sub_kingdom;
        document.getElementById("editSuperdivision").value =
            data.super_division;
        document.getElementById("editDivision").value = data.division;
        document.getElementById("editClass").value = data.class;
        document.getElementById("editSubClass").value = data.sub_class;
        document.getElementById("editOrdo").value = data.ordo;
        document.getElementById("editFamili").value = data.famili;
        document.getElementById("editGenus").value = data.genus;
        document.getElementById("editSpesies").value = data.species;
        document.getElementById("editDeskripsi").value = data.description;
        document.getElementById("editPlantLat").value = data.plant_lat;
        document.getElementById("editPlantLong").value = data.plant_long;

        const citySelect = document.getElementById("editCityName");
        const cityOptions = citySelect.querySelectorAll("option");
        cityOptions.forEach((option) => {
            if (option.value == data.city_id) {
                option.selected = true;
                document.getElementById("editProvinceName").value =
                    option.getAttribute("data-province");
            }
        });

        document.getElementById("imgPreviewPlantEdit").src = data.plant_image
            ? `/storage/${data.plant_image}`
            : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("imgPreviewLeafEdit").src = data.leaf_image
            ? `/storage/${data.leaf_image}`
            : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("imgPreviewStemEdit").src = data.stem_image
            ? `/storage/${data.stem_image}`
            : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("imgPreviewFlowerEdit").src = data.flower_image
            ? `/storage/${data.flower_image}`
            : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("imgPreviewFruitEdit").src = data.fruit_image
            ? `/storage/${data.fruit_image}`
            : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("imgPreviewAnotherEdit").src =
            data.another_image
                ? `/storage/${data.another_image}`
                : "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg";

        document.getElementById("editForm").dataset.spotId = spotId;
    }

    function attachEditListeners() {
        document.querySelectorAll(".btn-edit-spot").forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                const spotId = this.dataset.id;

                fetch(`/map/${spotId}/data`)
                    .then((response) => response.json())
                    .then((data) => {
                        populateEditForm(data, spotId);
                    })
                    .catch((error) =>
                        console.error("Gagal memuat data:", error)
                    );
            });
        });
    }

    attachEditListeners();

    // Submit update
    const editForm = document.getElementById("editForm");
    editForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const spotId = this.dataset.spotId;
        const formData = new FormData(editForm);
        formData.append("_method", "PUT");

        fetch(`/map/update/${spotId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    return response.text().then((text) => {
                        console.error("Server balas HTML:", text);
                        throw new Error("Gagal update. Server balas HTML.");
                    });
                }
                return response.json();
            })
            .then((data) => {
                // Tutup modal setelah berhasil update
                const modalEl = document.getElementById("editSpotModal");
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                // Update baris tabel
                const updatedRow = document.querySelector(
                    `#spot-row-${spotId}`
                );

                const updatedData = data.map || data;

                const {
                    local,
                    garden_name,
                    city_name,
                    province_name,
                    plant_lat,
                    plant_long,
                } = updatedData;

                if (updatedRow) {
                    updatedRow.innerHTML = `
                        <td>${updatedRow.children[0].textContent}</td>
                        <td>${local}</td>
                        <td>${garden_name}</td>
                        <td>${city_name || "-"}, ${province_name || "-"}</td>
                        <td>${plant_lat}</td>
                        <td>${plant_long}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-warning btn-edit-spot" data-id="${spotId}" data-bs-toggle="modal" data-bs-target="#editSpotModal">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="/map/${spotId}" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button class="btn btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    `;

                    // Tambahkan kembali listener edit
                    attachEditListeners();

                    loadSpots(data.map.garden_id);
                }

                // Tampilkan alert sukses
                document.getElementById("alert-container").innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data berhasil diperbarui.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            })
            .catch((error) => {
                console.error("Gagal submit:", error);
                document.getElementById("alert-container").innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${
                            error.message ||
                            "Terjadi kesalahan saat menyimpan data."
                        }
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const importForm = document.getElementById("importSpotForm");
    const alertContainer = document.getElementById("alert-container");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    if (importForm) {
        importForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const formData = new FormData(importForm);

            try {
                const response = await fetch(
                    "/import-from-excel/data/spot/tanaman",
                    {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                        body: formData,
                    }
                );

                const text = await response.text();
                let data;
                try {
                    data = JSON.parse(text);
                } catch (parseError) {
                    console.error("Bukan JSON:", text);
                    throw new Error(
                        "Respons server bukan format JSON yang valid."
                    );
                }

                if (!response.ok) {
                    throw new Error(data.message || "Gagal mengimpor data.");
                }

                // Tampilkan alert sukses
                alertContainer.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Berhasil impor data! Silakan muat ulang tabel, lalu edit latitude dan longitude tanaman.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

                importForm.reset();

                // Tutup modal
                const modalEl = document.getElementById("importListSpotModal");
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                // Refresh peta dan spot
                if (typeof loadSpots === "function") {
                    const selectedGardenId =
                        document.getElementById("selectedGardenId")?.value;
                    if (selectedGardenId) loadSpots(selectedGardenId);
                }

                // Tambah ke tabel jika data.maps tersedia
                if (Array.isArray(data.maps)) {
                    const tableBody =
                        document.querySelector("#spot-table tbody");
                    if (!tableBody) {
                        console.error("tbody tidak ditemukan!");
                        return;
                    }

                    // Hapus row "No records available" jika ada
                    const noDataRow = tableBody.querySelector("tr td[colspan]");
                    if (noDataRow) {
                        noDataRow.parentElement.remove(); // hapus baris kosong
                    }

                    // data.maps.forEach((spot, index) => {
                    //     const newRow = document.createElement("tr");
                    //     newRow.innerHTML = `
                    //         <td><input type="checkbox" class="spot-checkbox" data-id="${
                    //             spot.id
                    //         }"></td>
                    //         <td>${tableBody.rows.length + 1}</td>
                    //         <td>${spot.local}</td>
                    //         <td>${spot.garden_name}</td>
                    //         <td>
                    //             ${
                    //                 spot.city_name || spot.province_name
                    //                     ? `${spot.city_name ?? "-"}, ${
                    //                           spot.province_name ?? "-"
                    //                       }`
                    //                     : "-"
                    //             }
                    //         </td>
                    //         <td>${spot.plant_lat ?? ""}</td>
                    //         <td>${spot.plant_long ?? ""}</td>
                    //         <td>
                    //             <div class="d-flex gap-3">
                    //                 <a href="#" class="btn btn-warning btn-edit-spot" data-id="${
                    //                     spot.id
                    //                 }" data-bs-toggle="modal" data-bs-target="#editSpotModal">
                    //                     <i class="bi bi-pencil"></i>
                    //                 </a>
                    //                 <form action="/map/${
                    //                     spot.id
                    //                 }" method="post" class="d-inline">
                    //                     <input type="hidden" name="_method" value="delete">
                    //                     <input type="hidden" name="_token" value="${csrfToken}">
                    //                     <button class="btn btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data?')">
                    //                         <i class="bi bi-trash"></i>
                    //                     </button>
                    //                 </form>
                    //             </div>
                    //         </td>
                    //     `;
                    //     tableBody.appendChild(newRow);
                    // });
                }
            } catch (error) {
                console.error(error);
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal mengimpor file: ${error.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("selectAllCheckbox"); // Checkbox "Select All"
    const deleteAllBtnMobile = document.getElementById("deleteAllBtnMobile"); // Tombol mobile
    const deleteAllBtnDesktop = document.getElementById("deleteAllBtnDesktop"); // Tombol desktop
    const tableBody = document.querySelector("#spot-table tbody"); // Isi tabel
    const alertContainer = document.getElementById("alert-container"); // Tempat alert
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    if (
        !selectAllCheckbox ||
        !deleteAllBtnMobile ||
        !deleteAllBtnDesktop ||
        !tableBody
    ) {
        console.log("Some elements are missing");
        return;
    }

    function updateDeleteAllBtnState() {
        const checkedCount = document.querySelectorAll(
            ".spot-checkbox:checked"
        ).length;
        deleteAllBtnMobile.disabled = checkedCount === 0;
        deleteAllBtnDesktop.disabled = checkedCount === 0;
    }

    function handleDeleteAllClick() {
        const checkboxes = document.querySelectorAll(".spot-checkbox:checked");
        const spotIds = Array.from(checkboxes).map((cb) => cb.dataset.id);

        if (spotIds.length === 0) {
            alertContainer.innerHTML = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Pilih satu atau lebih spot untuk dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            return;
        }

        if (
            confirm(
                "Apakah kamu yakin ingin menghapus semua spot yang dipilih?"
            )
        ) {
            fetch("/delete-spots", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ ids: spotIds }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        checkboxes.forEach((checkbox) => {
                            const row = checkbox.closest("tr");
                            row.remove();
                        });
                        alertContainer.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Spot yang dipilih berhasil dihapus.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    } else {
                        alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal menghapus spot.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Terjadi kesalahan saat menghapus data: ${error.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                });
        }
    }

    // Event listener tombol
    deleteAllBtnMobile.addEventListener("click", handleDeleteAllClick);
    deleteAllBtnDesktop.addEventListener("click", handleDeleteAllClick);

    // Checkbox "Select All"
    selectAllCheckbox.addEventListener("change", function () {
        const checkboxes = document.querySelectorAll(".spot-checkbox");
        checkboxes.forEach((cb) => (cb.checked = selectAllCheckbox.checked));
        updateDeleteAllBtnState();
    });

    // Checkbox per baris
    tableBody.addEventListener("change", function (e) {
        if (e.target.classList.contains("spot-checkbox")) {
            updateDeleteAllBtnState();
        }
    });

    // Initial check
    updateDeleteAllBtnState();
});

document.addEventListener("DOMContentLoaded", function () {
    const collapseEl = document.getElementById("actionButtonsCollapse");
    const toggleButton = document.querySelector(
        '[data-bs-target="#actionButtonsCollapse"]'
    );

    // Pastikan elemen collapse tersedia
    if (collapseEl && toggleButton) {
        const collapseInstance = new bootstrap.Collapse(collapseEl, {
            toggle: false,
        });

        // Temukan semua tombol/a di dalam collapse
        const actionButtons = collapseEl.querySelectorAll("button, a");

        actionButtons.forEach((btn) => {
            btn.addEventListener("click", function () {
                if (window.innerWidth < 768) {
                    collapseInstance.hide(); // Tutup jika di mobile
                }
            });
        });
    }
});

document
    .querySelectorAll("#latTanaman, #longTanaman")
    .forEach(function (input) {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9.-]/g, "");
        });
    });

document
    .getElementById("refreshTableBtn")
    .addEventListener("click", function () {
        const url = this.getAttribute("data-url");
        fetch(url)
            .then((response) => response.text())
            .then((html) => {
                document.querySelector("#spot-table tbody").innerHTML = html;
            });
    });

// Toggle Description
// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelectorAll(".toggle-description").forEach(function (link) {
//         link.addEventListener("click", function (e) {
//             e.preventDefault();

//             const container = this.closest(".description-container");
//             const shortDesc = container.querySelector(".short-description");
//             const fullDesc = container.querySelector(".full-description");

//             if (fullDesc.classList.contains("d-none")) {
//                 shortDesc.classList.add("d-none");
//                 fullDesc.classList.remove("d-none");
//                 this.textContent = "Sembunyikan";
//             } else {
//                 fullDesc.classList.add("d-none");
//                 shortDesc.classList.remove("d-none");
//                 this.textContent = "Lihat Selengkapnya";
//             }
//         });
//     });
// });

// Preview
function showPreview(event, id) {
    const input = event.target;
    const preview = document.getElementById(id);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Zoom Image
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".img-clickable").forEach(function (img) {
        img.addEventListener("click", function () {
            var src = this.getAttribute("data-imgsrc");
            document.getElementById("zoomedImage").setAttribute("src", src);
        });
    });
});
