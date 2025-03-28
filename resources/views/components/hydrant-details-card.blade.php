<div class="row mt-1 mb-5">
    <div class="col-lg-12">
        <div class="card shadow-sm rounded">
            <div class="card-header py-3 bg-danger border-bottom">
                <div class="d-flex align-items-center">
                    <i class="fa fa-fire-extinguisher text-white fs-4 me-3"></i>
                    <h5 class="mb-0 fw-bold text-white">Hydrant Details</h5>
                </div>
                {{ $slot }}
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-wrap justify-content-between w-100 w-md-75 mx-auto text-center gap-3">

                    <!-- Code -->
                    <div class="d-flex align-items-center flex-grow-1 flex-md-nowrap flex-wrap">
                        <span class="bg-light p-2 rounded me-2">
                            <i class="fa-solid fa-qrcode text-success fs-5"></i> <!-- Ganti ikon -->
                        </span>
                        <div>
                            <h6 class="text-start text-dark fs-6 fw-bold mb-1">Code</h6>
                            <p class="text-start text-secondary fs-6 fw-semibold mb-0">{{ $code ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="d-flex align-items-center flex-grow-1 flex-md-nowrap flex-wrap">
                        <span class="bg-light p-2 rounded me-2">
                            <i class="fa-solid fa-location-dot text-primary fs-5"></i>
                        </span>
                        <div>
                            <h6 class="text-start text-dark fs-6 fw-bold mb-1">Lokasi</h6>
                            <p class="text-start text-secondary fs-6 fw-semibold mb-0">{{ $location ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Tipe -->
                    <div class="d-flex align-items-center flex-grow-1 flex-md-nowrap flex-wrap">
                        <span class="bg-light p-2 rounded me-2">
                            <i class="fa-solid fa-map-pin text-danger fs-5"></i>
                        </span>
                        <div>
                            <h6 class="text-start text-dark fs-6 fw-bold mb-1">Tipe</h6>
                            <p class="text-start text-secondary fs-6 fw-semibold mb-0">{{ $type ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Latitude -->
                    <div class="d-flex align-items-center flex-grow-1 flex-md-nowrap flex-wrap">
                        <span class="bg-light p-2 rounded me-2">
                            <i class="fa-solid fa-globe text-info fs-5"></i>
                        </span>
                        <div>
                            <h6 class="text-start text-dark fs-6 fw-bold mb-1">Latitude</h6>
                            <p class="text-start text-secondary fs-6 fw-semibold mb-0">{{ $latitude ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Longitude -->
                    <div class="d-flex align-items-center flex-grow-1 flex-md-nowrap flex-wrap">
                        <span class="bg-light p-2 rounded me-2">
                            <i class="fa-solid fa-ruler-horizontal text-warning fs-5"></i>
                        </span>
                        <div>
                            <h6 class="text-start text-dark fs-6 fw-bold mb-1">Longitude</h6>
                            <p class="text-start text-secondary fs-6 fw-semibold mb-0">{{ $longitude ?? 'N/A' }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>