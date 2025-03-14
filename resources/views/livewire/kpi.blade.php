<style>
    .card.kpi {
        transition: all 0.3s ease;
    }

    /* Efek hover */
    .card.kpi:hover {
        box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        cursor: pointer;
        transform: scale(1.05);
        transition: all 0.5s ease;
    }

    .card.kpi:hover .icon-shape {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('hydrant') }}" class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Hydrants</p>
                            <h5 class="font-weight-bolder mb-0">{{ $jumlahHydrant }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-list text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Hydrant belum di inspeksi</p>
                            <h5 class="font-weight-bolder mb-0">{{ $notInspected }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-circle-xmark  text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Hydrant telah di inspeksi</p>
                            <h5 class="font-weight-bolder mb-0">{{ $inspected }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-circle-check text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Hydrant Abnormal</p>
                            <h5 class="font-weight-bolder mb-0">{{ $abnormal }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-triangle-exclamation text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>