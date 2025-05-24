@extends('admin.app')

@section('dashboard')
    <section id="main" class="main">
        <h2 class="text-dark fw-bold text-wrap mb-4">
            Hai, {{ auth()->user()->username }} 👋😊
        </h2>

        <section class="section dashboard">
            <div class="row">

                {{-- Total Data Card --}}
                <x-dashboard.card title="Total Data" icon="bi bi-database-fill" count="{{ $mapCount }}"
                    added="{{ $addedCount }}" message="{{ $message }}" class="total-card" />

                {{-- Category 1 Data Card --}}
                <x-dashboard.card title="{{ $gardenFirstName }}" icon="bi bi-flower1" count="{{ $bogorCount }}"
                    added="{{ $bogorAdded }}" message="{{ $bogorMessage }}" class="category1-card" />

                {{-- Category 2 Data Card (Jika ada) --}}
                <x-dashboard.card title="{{ $gardenSecondName }}" icon="bi bi-tree-fill" count="{{ $cibodasCount }}"
                    added="{{ $cibodasAdded }}" message="{{ $cibodasMessage }}" class="category2-card" />

                {{-- Category 3 Data Card (Jika ada) --}}
                <x-dashboard.card title="{{ $gardenThirdName }}" icon="fa-solid fa-seedling" count="{{ $purwodadiCount }}"
                    added="{{ $purwodadiAdded }}" message="{{ $purwodadiMessage }}" class="category3-card" />

                {{-- Category 4 Data Card (Jika ada) --}}
                <x-dashboard.card title="{{ $gardenFourthName }}" icon="fa-solid fa-leaf" count="{{ $bedugulCount }}"
                    added="{{ $bedugulAdded }}" message="{{ $bedugulMessage }}" class="category4-card" />
            </div>
        </section>
    </section>
@endsection
