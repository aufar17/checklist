<div class="col-xl-3 col-sm-6 mb-4">
    @if($route)
    <a href="{{ route($route) }}" class="card kpi">
        @else
        <div class="card kpi">
            @endif
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $title }}</p>
                            <h5 class="font-weight-bolder mb-0">{{ $value }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-{{ $color }} shadow text-center border-radius-md">
                            <i class="fa-solid {{ $icon }} text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
            @if($route)
    </a>
    @else
</div>
@endif
</div>