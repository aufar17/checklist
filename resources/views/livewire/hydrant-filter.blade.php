<div>
    <div class="row mb-3 align-items-end">
        <div class="col-sm-2">
            <label for="filterYear" class="form-label">Year</label>
            <select wire:model="year" class="form-select form-control-sm" style="height: 38px;">
                <option value="">All</option>
                @foreach ($years as $y)
                <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-2">
            <label for="filterMonth" class="form-label">Month</label>
            <select wire:model="month" class="form-select form-control-sm" style="height: 38px;">
                <option value="">All</option>
                @foreach ($months as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-2">
            <label for="filterStatusHydrant" class="form-label">Status Hydrant</label>
            <select wire:model="statusHydrant" class="form-select form-control-sm" style="height: 38px;">
                <option value="">All</option>
                <option value="0">Normal</option>
                <option value="1">Abnormal</option>
            </select>
        </div>

        <div class="col-sm-2">
            <label for="filterApproval" class="form-label">Approval</label>
            <select wire:model="approval" class="form-select form-control-sm" style="height: 38px;">
                <option value="">All</option>
                <option value="0">Belum Inspeksi</option>
                <option value="1">Dibuat</option>
                <option value="2">Divalidasi oleh SPV</option>
                <option value="3">Divalidasi oleh Manager</option>
            </select>
        </div>
        <div class="col-sm-2">
            <button id="buttonfilter" wire:click="filter" class="btn btn-danger">Filter</button>
        </div>
    </div>


    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Hydrant</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Approval</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hydrants as $hydrant)
                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            </div>
                            <div class="modal-body">
                                Apakah yakin ingin menghapus hydrant
                                <strong class="text-danger">{{$hydrant['no_hydrant']}}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" action="{{ route('hydrant-delete') }}" method="POST">
                                    @csrf
                                    <input hidden type="text" name="id" id="productId" value="{{ $hydrant['id'] }}">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Validasi Inspeksi -->
                <div class="modal fade" id="trackingModal-{{ $hydrant['id'] }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title fw-bold text-white">Validasi Inspeksi</h5>
                                <button type="button" class="btn-close btn-close-light"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @php
                                $inspection = $hydrant['inspection_hydrants'][0] ?? null;
                                $statuses = [
                                ['label' => 'DIBUAT', 'user' => $inspection['created_by'] ?? 'Belum
                                dibuat', 'date' => $inspection['created_date'] ?? '', 'badge' =>
                                'danger', 'icon' => 'file-alt'],
                                ['label' => 'DIKETAHUI', 'user' => $inspection['known_by'] ?? 'Belum
                                diketahui', 'date' => $inspection['known_date'] ?? '', 'badge' =>
                                'warning', 'icon' => 'eye'],
                                ['label' => 'DIPERIKSA', 'user' => $inspection['checked_by'] ?? 'Belum
                                diperiksa', 'date' => $inspection['checked_date'] ?? '', 'badge' =>
                                'success', 'icon' => 'check-circle']
                                ];
                                $isRejected = in_array($hydrant['latest_status'], [4, 5]);
                                @endphp

                                <ul class="list-group">
                                    @foreach ($statuses as $status)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-{{ $status['badge'] }} me-3"><i
                                                    class="fas fa-{{ $status['icon'] }}"></i></span>
                                            <div>
                                                <h6 class="mb-0">{{ $status['label'] }}</h6>
                                                <small class="text-muted">{{ $status['user']
                                                    }}</small>
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $status['date'] }}</small>
                                    </li>
                                    @endforeach

                                    @if ($isRejected)
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-dark me-3"><i class="fas fa-times-circle"></i></span>
                                            <div>
                                                <h6 class="mb-0">DITOLAK</h6>
                                                <small class="text-white">
                                                    {{ $hydrant['latest_status'] == 4 ? 'Ditolak oleh
                                                    SPV' : 'Ditolak oleh Manager' }}
                                                </small>
                                            </div>
                                        </div>
                                        @if ($inspection['rejection_note'])
                                        <small class="fw-bold">Alasan: {{
                                            $inspection['rejection_note'] }}</small>
                                        @endif
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $hydrant['no_hydrant'] }}</td>
                    <td class="text-center">{{ $hydrant['location'] }}</td>
                    <td class="text-center">{{ $hydrant['type'] }}</td>
                    <td class="text-center">
                        @php
                        $statusList = [
                        0 => ['text' => 'Normal', 'class' => 'text-bg-success'],
                        1 => ['text' => 'Abnormal', 'class' => 'text-bg-danger'],
                        ];

                        $status = $statusList[$hydrant['latest_status_hydrant']] ?? ['text' => 'Tidak
                        Diketahui', 'class' => 'text-bg-secondary'];
                        @endphp

                        <button class="badge {{ $status['class'] }} p-1 px-2 border-0 fw-bold fs-7 tracking-btn"
                            data-bs-toggle="modal" data-bs-target="#kondisiModal-{{ $hydrant['id'] }}">
                            <span class="text-white fw-bold">{{ $status['text'] }}</span>
                        </button>
                    </td>

                    <div class="modal fade" id="kondisiModal-{{ $hydrant['id'] }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title fw-bold text-white">Kondisi Hydrant</h5>
                                    <button type="button" class="btn-close btn-close-light"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item">
                                            <strong>No. Hydrant:</strong> {{ $hydrant['no_hydrant'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Inspeksi Terakhir:</strong> {{
                                            $hydrant['latest_inspection_date'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Status Hydrant:</strong>
                                            <span
                                                class="badge {{ $hydrant['latest_status_hydrant'] ? 'text-bg-danger' : 'text-bg-success' }}">
                                                {{ $hydrant['latest_status_hydrant'] ? 'Abnormal' :
                                                'Normal' }}
                                            </span>
                                        </li>
                                    </ul>
                                    @if ($hydrant['latest_status_hydrant'] == 1)
                                    <div class="text-end">
                                        <button class="btn btn-success">PICA</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <td class="text-center">
                        @php
                        $statusList = [
                        0 => ['text' => 'Belum Inspeksi', 'class' => 'text-bg-warning'],
                        1 => ['text' => 'Dibuat', 'class' => 'text-bg-success'],
                        2 => ['text' => 'Approved by SPV', 'class' => 'text-bg-success'],
                        3 => ['text' => 'Approved by Manager', 'class' => 'text-bg-success'],
                        4 => ['text' => 'Rejected by SPV', 'class' => 'text-bg-danger'],
                        5 => ['text' => 'Rejected by Manager', 'class' => 'text-bg-danger'],
                        ];

                        // Pastikan latest_status berupa integer, jika tidak gunakan default 0
                        $statusKey = is_numeric($hydrant['latest_status']) ? (int) $hydrant['latest_status'] : 0;

                        $status = $statusList[$statusKey] ?? ['text' => 'Tidak Diketahui', 'class' =>
                        'text-bg-secondary'];

                        @endphp
                        <button class="badge {{ $status['class'] }} p-1 px-2 border-0 fw-bold fs-7 tracking-btn"
                            data-bs-toggle="modal" data-bs-target="#trackingModal-{{ $hydrant['id'] }}">
                            <span class="text-white fw-bold">{{ $status['text'] }}</span>
                        </button>
                    </td>


                    <td>
                        <a href="{{ route('detail-hydrant', ['id' => $hydrant['id']]) }}"
                            class="btn btn-info btn-sm p-2 border-0 rounded">
                            <i class="fa-solid fa-circle-info fs-6"></i>
                        </a>
                        <a href="{{ route('edit-hydrant', ['id' => $hydrant['id']]) }}"
                            class="btn btn-warning btn-sm p-2 border-0 rounded">
                            <i class="fa-solid fa-pen-to-square fs-6"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm p-2 border-0 rounded" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-id="{{ $hydrant['id'] }}">
                            <i class="fa-solid fa-trash fs-6"></i>
                        </button>

                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>