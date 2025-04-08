<div class="col-xxl-4 col-md-6">
    <div class="card info-card {{ $class ?? '' }}">
        <div class="card-body">
            <h5 class="card-title">{{ $title }} <span>| {{ $subtitle ?? 'Today' }}</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="{{ $icon }}"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ $count }}</h6>
                    @isset($added)
                        <span class="text-success small pt-1 fw-bold">{{ $added }}</span>
                    @endisset
                    @isset($message)
                        <span class="text-muted small pt-2 ps-1">{{ $message }}</span>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
