<style>
    table,
    th,
    td {
        border: 2px solid black !important;
        text-align: center;
    }

    th,
    td {
        padding: 5px;
    }

    .section-title {
        font-weight: bold;
        background-color: #ddd;
    }

    #left,
    #center,
    #right {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid black !important;
    }

    #center .col-12 {
        border-bottom: 2px solid black !important;
    }


    .custom-radio {
        width: 18px;
        height: 18px;
        appearance: none;
        border: 2px solid black !important;
        display: inline-block;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
    }

    .custom-radio:checked {
        background-color: black;
    }

    .custom-radio:checked::before {
        content: '✔';
        font-size: 14px;
        color: white;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>

{{ $slot }}
<div class="row gx-0 align-items-stretch">
    <div id="left" class="col-md-3 py-5 d-flex flex-column">
        <h4><strong>EHS DEPARTEMENT</strong></h4>
    </div>

    <div id="center" class="col-md-7 d-flex flex-column">
        <div class="row text-center w-100 flex-grow-1">
            <div class="col-12 py-3 border-bottom border-dark">
                <h4>INSPEKSI HIDRANT</h4>
            </div>
            <div id="no-hidran" class="col-md-6 py-3 text-center border-end border-dark">
                <span class="me-2">No. Hidran :</span>
                <span><strong>{{$code}}</strong></span>
            </div>
            <div class="col-md-6 py-3 d-flex align-items-center justify-content-center gap-2">
                {{ $type }}
            </div>
        </div>
    </div>

    <div id="right" class="col-md-2">
        <div class="row">
            <div class="col-md-12 w-100 d-flex justify-content-center">
                <span class="me-3"><strong>Tahun :</strong></span>
                <span>{{$year}}</span>
            </div>
            <div class="col-md-12 d-flex mt-2 justify-content-center">
                <span class="me-3"><strong>Lokasi :</strong></span>
                <span>{{$location}}</span>
            </div>
        </div>
    </div>

</div>
<div class="table-responsive">

    <table class="table table-hover table-bordered border-dark">
        <thead>
            <tr>
                <th rowspan="2" class="border border-dark">NO</th>
                <th rowspan="2" class="border border-dark">ITEM</th>
                <th colspan="12" class="border border-dark">BULAN</th>
            </tr>
            <tr>
                <th class="border border-dark">JAN</th>
                <th class="border border-dark">FEB</th>
                <th class="border border-dark">MAR</th>
                <th class="border border-dark">APR</th>
                <th class="border border-dark">MEI</th>
                <th class="border border-dark">JUN</th>
                <th class="border border-dark">JUL</th>
                <th class="border border-dark">AGU</th>
                <th class="border border-dark">SEP</th>
                <th class="border border-dark">OKT</th>
                <th class="border border-dark">NOV</th>
                <th class="border border-dark">DES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-dark">1</td>
                <td class="border border-dark">Tanggal Pemeriksaan</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="4" class="border border-dark">2</td>
                <td class="border border-dark"><strong>Kondisi Box Hydrant</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Tidak terhalang</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Pintu tidak rusak</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Terdapat identitas hidran</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="4" class="border border-dark">3</td>
                <td class="border border-dark">
                    <span class="me-2">
                        <strong>Selang</strong>
                    </span>
                    <input disabled type="checkbox"> 1.5 inch
                    <input disabled type="checkbox"> 2.5 inch
                </td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah selang</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Tidak ada yang bocor</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Coupling tidak rusak</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="5" class="border border-dark">4</td>
                <td class="border border-dark">
                    <span class="me-2"><strong>Nozle</strong></span>
                    <input disabled type="checkbox"> Jet
                    <input disabled type="checkbox"> Spray
                </td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Seal tidak rusak</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Body tidak rusak</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Coupling tidak rusak</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>

            <tr>
                <td rowspan="3" class="border border-dark">5</td>
                <td class="border border-dark"><strong>Kran</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Kondisi tidak bocor/rembes</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="3" class="border border-dark">6</td>
                <td class="border border-dark"><strong>Kunci Pembuka Kran</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Kondisi tidak bocor/rembes</td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="1" class="border border-dark">7</td>
                <td class="border border-dark"><strong>Manipold bocor/rusak</strong></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="1" class="border border-dark">8</td>
                <td class="border border-dark"><strong>Segel Pemeriksaan</strong></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td rowspan="2" class="border border-dark">9</td>
                <td class="border border-dark"><strong>Tanda tangan pemeriksa</strong></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark"><strong>Nama Pemeriksa</strong></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
                <td class="border border-dark"></td>
            </tr>
        </tbody>
    </table>
</div>


<div class="table-responsive">
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th colspan="3" style="width: 50%;">Notes</th>
                <th style="width: 16%;">Diketahui</th>
                <th style="width: 16%;">Diperiksa</th>
                <th style="width: 16%;">Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" class="p-5 border-end border-dark"><strong>NOTE:</strong> * Untuk ditempatkan di dalam
                    Box</td>
                <td class="p-4 border-end border-dark">Dept Head</td>
                <td class="p-4 border-end border-dark">Supervisor</td>
                <td class="p-4">Safety Officer</td>
            </tr>
        </tbody>
    </table>
</div>