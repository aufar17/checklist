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
    <!-- Total Mesin -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <a href="{{ route('hydrant') }}" class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Mesin</p>
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

    <!-- Mesin belum di inspeksi -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Mesin belum di inspeksi</p>
                            <h5 class="font-weight-bolder mb-0">{{ $notInspected }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-circle-xmark text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mesin telah di inspeksi -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Mesin telah di inspeksi</p>
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

    <!-- Mesin Bermasalah (Belum Lapor) -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-9">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Mesin Bermasalah (Belum Lapor)</p>
                            <h5 class="font-weight-bolder mb-0">{{ $abnormal }}</h5>
                        </div>
                    </div>
                    <div class="col-3 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-triangle-exclamation text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mesin Bermasalah (Sudah Lapor) -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="numbers">
                        <p class="text-sm mb-1 text-capitalize font-weight-bold">Mesin Bermasalah (Sudah Lapor)</p>
                        <h5 class="font-weight-bolder mb-0">{{ $abnormal }}</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                        <i class="fa-solid fa-flag text-white text-lg opacity-10"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mesin tidak bisa operasi -->
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card kpi">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Mesin tidak bisa operasi</p>
                            <h5 class="font-weight-bolder mb-0">{{ $abnormal }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-ban text-white text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>