document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("selectAllCheckbox");
    const deleteAllBtnMobile = document.getElementById("deleteAllBtnMobile");
    const deleteAllBtnDesktop = document.getElementById("deleteAllBtnDesktop");
    const tableBody = document.querySelector("#garden-table tbody");
    const alertContainer = document.getElementById("alert-container");
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
            ".garden-checkbox:checked"
        ).length;
        deleteAllBtnMobile.disabled = checkedCount === 0;
        deleteAllBtnDesktop.disabled = checkedCount === 0;
    }

    function handleDeleteAllClick() {
        const checkboxes = document.querySelectorAll(
            ".garden-checkbox:checked"
        );
        const gardenIds = Array.from(checkboxes).map((cb) => cb.dataset.id);

        if (gardenIds.length === 0) {
            alertContainer.innerHTML = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Pilih satu atau lebih kebun untuk dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            return;
        }

        if (
            confirm(
                "Apakah kamu yakin ingin menghapus semua kebun yang dipilih?"
            )
        ) {
            fetch("/delete-gardens", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ ids: gardenIds }),
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
                            kebun yang dipilih berhasil dihapus.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    } else {
                        alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal menghapus kebun.
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

    deleteAllBtnMobile.addEventListener("click", handleDeleteAllClick);
    deleteAllBtnDesktop.addEventListener("click", handleDeleteAllClick);

    selectAllCheckbox.addEventListener("change", function () {
        const checkboxes = document.querySelectorAll(".garden-checkbox");
        checkboxes.forEach((cb) => (cb.checked = selectAllCheckbox.checked));
        updateDeleteAllBtnState();
    });

    tableBody.addEventListener("change", function (e) {
        if (e.target.classList.contains("garden-checkbox")) {
            updateDeleteAllBtnState();
        }
    });

    updateDeleteAllBtnState();
});

$(function () {
    // Saat klik tombol edit, ambil data garden dari server (AJAX)
    $(".btn-edit-garden").click(function () {
        const slug = $(this).data("slug");

        $.get(`/garden/${slug}/edit`, function (data) {
            $("#editGardenSlug").val(data.slug);
            $("#editGardenName").val(data.name);
        });
    });

    // Submit form update via AJAX
    $("#editGardenForm").submit(function (e) {
        e.preventDefault();

        const slug = $("#editGardenSlug").val();
        const name = $("#editGardenName").val();
        const token = $('input[name="_token"]').val();
        const method = "PATCH";

        $.ajax({
            url: `/garden/${slug}`,
            type: "POST",
            data: {
                _token: token,
                _method: method,
                name: name,
            },
            success: function (res) {
                alert(res.message);
                location.reload(); // reload halaman setelah update berhasil
            },
            error: function (xhr) {
                alert("Gagal update: " + xhr.responseJSON.message ?? "Error");
            },
        });
    });
});
