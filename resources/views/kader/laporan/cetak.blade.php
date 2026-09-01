<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Posyandu - {{ $kategori }}</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { font-size: 16px; margin: 0 0 5px 0; text-transform: uppercase; letter-spacing: 1px; }
        .header h2 { font-size: 13px; margin: 0 0 5px 0; font-weight: normal; }
        .meta { margin-bottom: 15px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #777; padding: 6px; text-align: center; vertical-align: middle; }
        th { background-color: #f0f0f0; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .text-left { text-align: left; }
        .ttd-container { width: 100%; margin-top: 40px; }
        .ttd-box { width: 30%; float: right; text-align: center; }
    </style>
</head>
<body>

    @php
        $namabulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    @endphp

    <div class="header">
        <h1>Pemerintah Kabupaten Pekalongan</h1>
        <h2>Laporan Hasil Pelayanan Unit Posyandu (SIPOSDIG)</h2>
        <h2>Kategori Sasaran: <b>{{ strtoupper($kategori) }}</b> | Periode: <b>{{ $namabulan[intval($bulan)] }} {{ $tahun }}</b></h2>
    </div>

    <div class="meta">Total Pemeriksaan: {{ $dataLaporan->count() }} Orang</div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="15%" class="text-left">Nama Warga</th>
                <th width="10%">NIK</th>
                <th width="5%">L/P</th>
                <th width="7%">Tgl Ukur</th>
                <th width="6%">BB(kg)</th>
                <th width="6%">TB(cm)</th>

                <!-- KOLOM DINAMIS BERDASARKAN KATEGORI -->
                @if($kategori == 'Balita')
                    <th width="8%">L.Kepala</th>
                    <th width="10%">Stunting</th>
                @elseif($kategori == 'Remaja')
                    <th width="7%">LILA</th>
                    <th width="8%">L.Perut</th>
                    <th width="8%">Tensi</th>
                @elseif($kategori == 'Lansia')
                    <th width="8%">Tensi</th>
                    <th width="8%">G.Darah</th>
                    <th width="8%">Koles.</th>
                    <th width="8%">As.Urat</th>
                @else
                    <th width="8%">IMT</th>
                    <th width="15%">Info Spesifik</th>
                @endif
                
                <th width="12%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataLaporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left">{{ $item->warga->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->warga->nik ?? '-' }}</td>
                <td>{{ $item->warga->jenis_kelamin ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_ukur)->format('d/m/Y') }}</td>
                <td>{{ $item->berat_badan ?? '-' }}</td>
                <td>{{ $item->tinggi_badan ?? '-' }}</td>

                <!-- DATA DINAMIS BERDASARKAN KATEGORI -->
                @if($kategori == 'Balita')
                    <td>{{ $item->lingkar_kepala ?? '-' }}</td>
                    <td>{{ $item->status_stunting ? ucwords(str_replace('_', ' ', $item->status_stunting)) : '-' }}</td>
                @elseif($kategori == 'Remaja')
                    <td>{{ $item->lila ?? '-' }}</td>
                    <td>{{ $item->lingkar_perut ?? '-' }}</td>
                    <td>{{ $item->sistol }}/{{ $item->diastol }}</td>
                @elseif($kategori == 'Lansia')
                    <td>{{ $item->sistol }}/{{ $item->diastol }}</td>
                    <td>{{ $item->gula_darah ?? '-' }}</td>
                    <td>{{ $item->kolesterol ?? '-' }}</td>
                    <td>{{ $item->asam_urat ?? '-' }}</td>
                @else
                    <td>{{ $item->imt ?? '-' }}</td>
                    <td>
                        @if($item->kategori_saat_ukur == 'Balita') Stunting: {{ $item->status_stunting }}
                        @elseif($item->kategori_saat_ukur == 'Lansia') Gula: {{ $item->gula_darah }}
                        @endif
                    </td>
                @endif

                <td class="text-left">{{ $item->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="12" style="padding: 20px;">Tidak ada data pengukuran pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Pekalongan, {{ date('d') }} {{ $namabulan[intval(date('m'))] }} {{ date('Y') }}</p>
            <p style="margin-bottom: 70px;">Penanggung Jawab Kader</p>
            <p><b><u>{{ auth('kader')->user()->nama_lengkap }}</u></b></p>
        </div>
    </div>

</body>
</html>