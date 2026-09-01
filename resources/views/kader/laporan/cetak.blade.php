<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Posyandu - {{ $kategori }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1e293b; margin: 0; padding: 30px; font-size: 12px; background: #ffffff; }
        .no-print { background: #eff6ff; border: 1px solid #bfdbfe; padding: 15px 20px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
        .no-print span { font-weight: bold; color: #1e40af; font-size: 13px; }
        .btn-print { padding: 10px 20px; background: #2563eb; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; box-shadow: 0 4px 12px rgba(37,99,235,0.2); }
        .btn-print:hover { background: #1d4ed8; }
        .header { text-align: center; border-bottom: 3px double #1e293b; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { font-size: 18px; margin: 0; text-transform: uppercase; font-weight: 900; }
        .header h2 { font-size: 14px; margin: 5px 0; text-transform: uppercase; color: #2563eb; }
        .header p { font-size: 11px; color: #64748b; margin: 0; }
        .meta-info { margin-bottom: 15px; font-weight: bold; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px 10px; text-align: left; }
        th { background-color: #f1f5f9; color: #334155; font-size: 11px; text-transform: uppercase; font-weight: 800; }
        td { font-size: 11px; }
        .text-center { text-align: center; }
        .footer { width: 100%; margin-top: 50px; page-break-inside: avoid; }
        .sign-box { text-align: center; width: 250px; float: right; }
        @media print {
            body { padding: 0; background: #ffffff; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <!-- Panel Informasi di Halaman Cetak -->
    <div class="no-print">
        <span>💡 Tips: Pilih <b>"Save as PDF"</b> pada tujuan printer untuk mengunduh dokumen dalam bentuk PDF.</span>
        <button onclick="window.print()" class="btn-print">🖨️ Cetak / Simpan PDF Sekarang</button>
    </div>

    @php
        $namabulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    @endphp

    <div class="header">
        <h1>Pemerintah Kabupaten Batang</h1>
        <h2>Laporan Bulanan Unit Posyandu (SIPOSDIG)</h2>
        <p>Kategori Sasaran: <b>{{ $kategori }}</b> | Periode Bulan: <b>{{ $namabulan[intval($bulan)] }} {{ $tahun }}</b></p>
    </div>

    <div class="meta-info">
        Total Data Tercatat: {{ $dataLaporan->count() }} Sesi Pengukuran
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="25%">Nama Warga & NIK</th>
                <th class="text-center" width="12%">Kategori</th>
                <th class="text-center" width="10%">Tgl Ukur</th>
                <th class="text-center" width="10%">BB (kg)</th>
                <th class="text-center" width="10%">TB (cm)</th>
                <th class="text-center" width="10%">IMT / Info</th>
                <th width="18%">Catatan Medis</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataLaporan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <b>{{ $item->warga->nama_lengkap ?? '-' }}</b><br>
                    <span style="font-size: 10px; color: #64748b;">NIK: {{ $item->warga->nik ?? '-' }}</span>
                </td>
                <td class="text-center">{{ $item->kategori_saat_ukur }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_ukur)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $item->berat_badan ?? '-' }}</td>
                <td class="text-center">{{ $item->tinggi_badan ?? '-' }}</td>
                <td class="text-center">
                    @if($item->kategori_saat_ukur == 'Balita')
                        {{ $item->status_stunting ? ucfirst($item->status_stunting) : '-' }}
                    @else
                        {{ $item->imt ?? '-' }}
                    @endif
                </td>
                <td>{{ $item->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 20px; color: #64748b;">Tidak ada data pengukuran pada periode dan kategori ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="sign-box">
            <p>Batang, {{ date('d') }} {{ $namabulan[intval(date('m'))] }} {{ date('Y') }}</p>
            <p style="margin-bottom: 60px;">Penanggung Jawab Kader</p>
            <p><b><u>{{ auth('kader')->user()->nama_lengkap }}</u></b></p>
        </div>
    </div>

    <!-- Script otomatis memunculkan dialog cetak/pdf saat tab terbuka -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>