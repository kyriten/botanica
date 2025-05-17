<style>
    #search-input::placeholder {
        color: #626f47;
        opacity: 1;
    }

    #search-input:focus {
        border-color: #dfe1e5;
    }

    #autocomplete-list li {
        cursor: pointer;
        padding: 10px 16px;
    }

    #autocomplete-list li:hover {
        background-color: #f1f3f4;
    }

    /* Normal state: border biasa */
    #search-input-group {
        border: 1px solid transparent;
        border-radius: 999px;
        /* biar tetap bentuk pill */
        transition: box-shadow 0.2s, border-color 0.2s;
    }

    /* Fokus state seluruh grup */
    #search-input-group:focus-within {
        border: 1px solid #a2c284;
        /* warna fokus, bisa disesuaikan */
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        background-color: white;
    }

    /* Optional: full viewport height for centering */
    .vh-100 {
        height: 100vh;
    }

    /* transisi untuk smooth position change */
    #plant-search-form {
        transition: margin 0.3s ease-in-out;
    }
</style>
