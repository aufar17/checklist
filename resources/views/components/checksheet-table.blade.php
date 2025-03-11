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
                @foreach (range(1, 12) as $month)
                <th>{{ DateTime::createFromFormat('!m', $month)->format('M') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-dark">1</td>
                <td class="border border-dark">Tanggal Pemeriksaan</td>
                {{ $tanggal_pemeriksaan }}
            </tr>
            <tr>
                <td rowspan="4" class="border border-dark">2</td>
                <td class="border border-dark"><strong>Kondisi Box Hydrant</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Posisi sesuai</td>
                {{ $posisi }}
            </tr>
            <tr>
                <td class="border border-dark">- Pintu bagus</td>
                {{ $pintu }}
            </tr>
            <tr>
                <td class="border border-dark">- Identitas ada</td>
                {{ $identitas }}
            </tr>
            <tr>
            <tr>
                <td rowspan="4" class="border border-dark">3</td>
                <td class="border border-dark"><strong>Selang</strong> | <strong>{{ $panjang_selang }} inch</strong>
                </td>
                <td colspan="12" class="bg-dark"></td>


            </tr>

            </tr>
            <tr>
                <td class="border border-dark">- Jumlah selang</td>
                {{ $jumlah_selang }}

            </tr>
            <tr>
                <td class="border border-dark">- Kondisi bagus</td>
                {{ $kondisi_selang }}

            </tr>
            <tr>
                <td class="border border-dark">- Coupling bagus</td>
                {{ $coupling_selang }}
            </tr>
            <tr>
                <td rowspan="5" class="border border-dark">4</td>
                <td class="border border-dark"><strong>Nozle</strong> | <strong>{{ $jenis_nozle }}</strong></td>
                <td colspan="12" class="bg-dark"></td>

            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                {{ $jumlah_nozle }}

            </tr>
            <tr>
                <td class="border border-dark">- Seal bagus</td>
                {{ $seal_nozle }}

            </tr>
            <tr>
                <td class="border border-dark">- Body bagus</td>
                {{ $body_nozle }}

            </tr>
            <tr>
                <td class="border border-dark">- Coupling bagus</td>
                {{ $coupling_nozle }}

            </tr>

            <tr>
                <td rowspan="3" class="border border-dark">5</td>
                <td class="border border-dark"><strong>Kran</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                {{ $jumlah_kran }}

            </tr>
            <tr>
                <td class="border border-dark">- Kondisi bagus</td>
                {{ $kondisi_kran }}

            </tr>
            <tr>
                <td rowspan="3" class="border border-dark">6</td>
                <td class="border border-dark"><strong>Kunci Pembuka Kran</strong></td>
                <td colspan="12" class="bg-dark"></td>
            </tr>
            <tr>
                <td class="border border-dark">- Jumlah</td>
                {{ $jumlah_kunci }}

            </tr>
            <tr>
                <td class="border border-dark">- Kondisi bagus</td>
                {{ $kondisi_kunci }}

            </tr>
            <tr>
                <td rowspan="1" class="border border-dark">7</td>
                <td class="border border-dark"><strong>Manipold bagus</strong></td>
                {{ $kondisi_manipold }}

            </tr>
            <tr>
                <td rowspan="3" class="border border-dark">8</td>
                <td class="border border-dark"><strong>Nama Pemeriksa</strong></td>
                {{$pemeriksa}}
            </tr>
            <tr>
                <td class="border border-dark"><strong>Bukti Pemeriksaan</strong></td>
                {{$bukti}}
            </tr>
        </tbody>
    </table>
</div>


<div class="table-responsive">
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th style="width: 16%;">Diketahui</th>
                <th style="width: 16%;">Diperiksa</th>
                <th style="width: 16%;">Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-4 border-end border-dark">Dept Head</td>
                <td class="p-4 border-end border-dark">Supervisor</td>
                <td class="p-4">Safety Officer</td>
            </tr>
        </tbody>
    </table>
</div>

{{ $approve }}