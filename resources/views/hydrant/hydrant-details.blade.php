<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================
    
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<x-head></x-head>
<style>
    #radiocheck {
        border: 2px solid black
    }
</style>

<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>
            @slot('title')
            Hydrant Details
            @endslot

            @slot('role')
            {{ $user->name }}
            @endslot

        </x-navbar>
        <div class="container-fluid py-4">
            <x-hydrant-details-card>
                @slot('code')
                {{ $hydrant->no_hydrant }}
                @endslot
                @slot('location')
                {{ $hydrant->location }}
                @endslot
                @slot('type')
                {{ $hydrant->type }}
                @endslot
                @slot('latitude')
                {{ $hydrant->latitude }}
                @endslot
                @slot('longitude')
                {{ $hydrant->longitude }}
                @endslot
            </x-hydrant-details-card>
            <x-card>
                @slot('title')
                Inspection History
                @endslot
                @slot('body')
                <x-checksheet-table>
                    @slot('code')
                    {{ $hydrant->no_hydrant }}
                    @endslot

                    @slot('location')
                    {{ $hydrant->location }}
                    @endslot

                    @slot('year')
                    {{ now()->format('Y') }}
                    @endslot

                    @slot('type')
                    <span>Indoor</span>
                    <input disabled type="radio" class="custom-radio" @checked($hydrant->type == 'Indoor')>
                    <span>Outdoor</span>
                    <input disabled type="radio" class="custom-radio" @checked($hydrant->type == 'Outdoor')>
                    @endslot

                    @slot('tanggal_pemeriksaan')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        {{ $allMonths[$month]->first()->inspection_date ?? '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot


                    @slot('posisi')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 1)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('pintu')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 2)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot


                    @slot('identitas')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 3)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('panjang_selang')
                    {{-- @foreach (range(1, 12) as $month)
                    <td class="border border-dark">
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 5)->pluck('values')->toArray();
                        @endphp
                        <input disabled type="checkbox" class="custom-radio" @checked(in_array('1.5', $filtered))> 1.5
                        inch
                        <input disabled type="checkbox" class="custom-radio" style="margin-left: 10px"
                            @checked(in_array('2.5', $filtered))> 2.5
                        inch
                        @else

                        @endif
                    </td>
                    @endforeach --}}

                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 5)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot


                    @slot('jumlah_selang')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 4)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot



                    @slot('kondisi_selang')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id',6 )->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('coupling_selang')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 7)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('jenis_nozle')
                    {{-- @foreach (range(1, 12) as $month)
                    <td class="border border-dark">
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 8)->pluck('values')->toArray();
                        @endphp
                        <input disabled type="checkbox" class="custom-radio" @checked(in_array('Jet', $filtered))> Jet
                        <input disabled type="checkbox" class="custom-radio" style="margin-left: 10px"
                            @checked(in_array('Spray', $filtered))>
                        Spray
                        @else

                        @endif
                    </td>
                    @endforeach --}}
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 8)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('jumlah_nozle')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 9)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('seal_nozle')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 10)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('body_nozle')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 11)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('coupling_nozle')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 12)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('jumlah_kran')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 13)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('kondisi_kran')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 14)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('jumlah_kunci')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 15)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('kondisi_kunci')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 16)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('kondisi_manipold')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 17)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('kondisi_segel')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        @php
                        $filtered = $allMonths[$month]->where('inspection_id', 18)->pluck('values');
                        @endphp
                        {{ $filtered->isNotEmpty() ? $filtered->implode(', ') : '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('pemeriksa')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty())
                        {{ $allMonths[$month]->first()->created_by ?? '-' }}
                        @else

                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('notes')
                    @foreach (range(1, 12) as $month)
                    @if ($allMonths[$month]->isNotEmpty())
                    {{ $allMonths[$month]->first()->notes ?? '-' }}
                    @else
                    @endif
                    @endforeach
                    @endslot

                    @slot('bukti')
                    @foreach (range(1, 12) as $month)
                    <td>
                        @if ($allMonths[$month]->isNotEmpty() && $allMonths[$month]->first()->documentation)

                        <button class="badge bg-success border-0" data-bs-toggle="modal"
                            data-bs-target="#modalBukti{{ $month }}">
                            Dokumentasi
                        </button>

                        <div class="modal fade" id="modalBukti{{ $month }}" tabindex="-1"
                            aria-labelledby="modalLabel{{ $month }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white" id="modalLabel{{ $month }}">Bukti Dokumentasi
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/documentation/' . $allMonths[$month]->first()->documentation) }}"
                                            class="img-fluid w-75" alt="Bukti Dokumentasi"
                                            style="max-height: 800px; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </td>
                    @endforeach
                    @endslot

                    @slot('approve')

                    @php
                    $isManager = $user->golongan == 4 && $user->acting == 1;
                    $isSPV = $user->golongan == 4 && $user->acting == 2;
                    $canValidate = ($isManager && $hydrant->status == 2) || ($isSPV && $hydrant->status == 1);
                    @endphp

                    @if ($canValidate)
                    <!-- Modal Validasi -->
                    <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="validasiModalLabel">Form Validasi Hydrant</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route($isManager ? 'manager-validation' : 'spv-validation') }}"
                                    method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="hydrant_id" value="{{ $hydrant->id }}">

                                        <div class="mb-3">
                                            <label for="status" class="form-label">STATUS</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option disabled selected>-- Pilih Status --</option>
                                                @if ($isManager)
                                                <option value="3">Approve</option>
                                                <option value="5">Reject</option>
                                                @elseif ($isSPV)
                                                <option value="2">Approve</option>
                                                <option value="4">Reject</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mb-3" id="notesField" style="display: none;">
                                            <label for="notes" class="form-label">CATATAN <strong
                                                    class="text-danger">*</strong></label>
                                            <textarea name="notes" id="notes" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Validasi -->
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-warning text-dark" data-bs-toggle="modal"
                            data-bs-target="#validasiModal">
                            Validasi
                        </button>
                    </div>
                    @endif
                    @endslot
                </x-checksheet-table>
                @endslot
            </x-card>
            <x-footer></x-footer>
        </div>
    </main>



    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/curve-chart.js') }}"></script>
    <script src="js/data-table.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const statusSelect = document.getElementById("status");
            const notesField = document.getElementById("notesField");
    
            statusSelect.addEventListener("change", function () {
                if (this.value === "4") {
                    notesField.style.display = "block";
                    document.getElementById("notes").setAttribute("required", "true");
                } else {
                    notesField.style.display = "none";
                    document.getElementById("notes").removeAttribute("required");
                }
            });
        });
    </script>



</body>

</html>