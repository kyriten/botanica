@extends('admin.app')

@section('dashboard')
    <section id="main" class="main">
        <h2 class="text-dark fw-bold text-wrap mb-4">
            Hai, {{ auth()->user()->username }} 👋😊
        </h2>

        <section class="section dashboard">
            <div class="row">

                {{-- Total Data Card --}}
                <x-dashboard.card
                    title="Total Data"
                    icon="bi bi-database-fill"
                    count="{{ $postCount }}"
                    added="{{ $addedCount }}"
                    message="{{ $message }}"
                    class="total-card"
                />

                {{-- Category 1 Data Card --}}
                <x-dashboard.card
                    title="{{ $categoryFirstName }}"
                    icon="bi bi-flower1"
                    count="{{ $category1Count }}"
                    added="{{ $category1Added }}"
                    message="{{ $category1Message }}"
                    class="category1-card"
                />

                {{-- Category 2 Data Card (Jika ada) --}}
                <x-dashboard.card
                    title="{{ $categorySecondName }}"
                    icon="bi bi-tree-fill"
                    count="{{ $category2Count }}"
                    added="{{ $category2Added }}"
                    message="{{ $category2Message }}"
                    class="category2-card"
                />

                {{-- Category 3 Data Card (Jika ada) --}}
                <x-dashboard.card
                    title="{{ $categoryThirdName }}"
                    icon="fa-solid fa-seedling"
                    count="{{ $category3Count }}"
                    added="{{ $category3Added }}"
                    message="{{ $category3Message }}"
                    class="category3-card"
                />

                {{-- Category 4 Data Card (Jika ada) --}}
                <x-dashboard.card
                    title="{{ $categoryFourthName }}"
                    icon="fa-solid fa-leaf"
                    count="{{ $category4Count }}"
                    added="{{ $category4Added }}"
                    message="{{ $category4Message }}"
                    class="category4-card"
                />
            </div>
        </section>
    </section>
@endsection
