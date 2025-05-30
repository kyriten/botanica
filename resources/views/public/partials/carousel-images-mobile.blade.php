<div id="plantImageCarouselMobile" class="carousel slide mb-3" data-bs-ride="carousel">
    <div class="carousel-inner rounded position-relative">
        @foreach ($images as $index => $img)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="position-relative text-center">
                    <div
                        class="position-absolute top-0 start-50 translate-middle-x bg-botanica text-white px-3 py-1 rounded-bottom text-sm z-3">
                        {{ $img['label'] }}
                    </div>
                    <img src="{{ $img['src'] }}" class="d-block w-100 rounded" style="height: 400px; object-fit: cover;"
                        alt="Gambar {{ $img['label'] }}">
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#plantImageCarouselMobile"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#plantImageCarouselMobile"
        data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
