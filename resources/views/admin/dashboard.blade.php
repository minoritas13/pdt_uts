@extends('layouts.admin')

@section('title', ($isManagement ?? false) ? 'Kelola Buku — SPBT Admin' : 'Beranda — SPBT Admin')

@push('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    /* ─── STAT CARDS ─── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--white);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--gray-200);
        transition: box-shadow 0.2s;
    }

    .stat-card:hover { box-shadow: 0 4px 20px rgba(26,46,90,0.08); }

    .stat-card.dark {
        background: var(--navy);
        border-color: var(--navy);
        color: var(--white);
    }

    .stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .stat-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        background: var(--gray-100);
        display: flex; align-items: center; justify-content: center;
    }

    .stat-card.dark .stat-icon { background: rgba(255,255,255,0.12); }

    .stat-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--green);
        margin-top: 4px;
    }

    .stat-dot.gray { background: rgba(255,255,255,0.3); }

    .stat-label {
        font-size: 12.5px;
        color: var(--gray-400);
        font-weight: 500;
        margin-bottom: 6px;
    }

    .stat-card.dark .stat-label { color: rgba(255,255,255,0.6); }

    .stat-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--gray-800);
        line-height: 1;
    }

    .stat-card.dark .stat-value { color: var(--white); }

    /* ─── CHART ─── */
    .chart-card {
        background: var(--white);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid var(--gray-200);
        margin-bottom: 24px;
    }

    .chart-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .chart-title { font-size: 16px; font-weight: 700; color: var(--gray-800); }
    .chart-subtitle { font-size: 12.5px; color: var(--gray-400); margin-top: 2px; }

    .chart-actions { display: flex; gap: 8px; }

    .btn-outline {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: 1.5px solid var(--gray-200);
        background: var(--white);
        color: var(--gray-600);
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.18s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-outline:hover { border-color: var(--navy); color: var(--navy); }

    .btn-primary {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        background: var(--navy);
        color: var(--white);
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.18s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-primary:hover { background: var(--navy-light); }

    .chart-wrap { width: 100%; height: 220px; }

    /* ─── TABLE ─── */
    .table-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }

    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px 16px;
    }

    .table-title { font-size: 16px; font-weight: 700; color: var(--gray-800); }

    .lihat-semua {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--navy);
        text-decoration: none;
        transition: gap 0.15s;
    }

    .lihat-semua:hover { gap: 8px; }

    table { width: 100%; border-collapse: collapse; }

    thead tr { border-top: 1px solid var(--gray-100); border-bottom: 1px solid var(--gray-100); }

    th {
        padding: 10px 24px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        background: var(--gray-50);
    }

    td {
        padding: 14px 24px;
        font-size: 13.5px;
        color: var(--gray-800);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    .trx-id { font-weight: 700; color: var(--navy); }

    .pelanggan-cell { display: flex; align-items: center; gap: 10px; }

    .pelanggan-avatar {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: var(--navy-light);
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 12px; font-weight: 700;
        flex-shrink: 0;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
    }

    .badge-success { background: var(--green-bg); color: #15803d; }
    .badge-pending { background: var(--yellow-bg); color: #a16207; }
    .badge-cancelled { background: var(--red-bg); color: #b91c1c; }

    .total-col { font-weight: 700; text-align: right; }

    /* ─── FOOTER ─── */
    .page-footer {
        text-align: center;
        padding: 24px 0 8px;
        font-size: 12px;
        color: var(--gray-400);
    }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .chart-actions { display: none; }
        th, td { padding: 10px 16px; }
    }
</style>
@endpush

@section('content')

{{-- TAMPILKAN GRAFIK DAN STAT CARDS HANYA JIKA BUKAN DALAM MODE KELOLA BUKU --}}
@if(empty($isManagement) || $isManagement === false)
    <div class="page-header">
        <h1>Selamat Datang Kembali!</h1>
        <p>Berikut adalah ringkasan aktivitas toko buku hari ini.</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon">
                    <svg width="20" height="20" fill="none" stroke="#1a2e5a" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="stat-dot"></div>
            </div>
            <div class="stat-label">Total Koleksi Buku</div>
            <div class="stat-value">{{ number_format($buku->count()) }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon">
                    <svg width="20" height="20" fill="none" stroke="#1a2e5a" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div class="stat-dot"></div>
            </div>
            <div class="stat-label">Total Judul Buku</div>
            <div class="stat-value">{{ number_format($buku->count()) }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon">
                    <svg width="20" height="20" fill="none" stroke="#1a2e5a" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="stat-dot"></div>
            </div>
            <div class="stat-label">Jumlah Penerbit</div>
            <div class="stat-value">{{ number_format($buku->pluck('penerbit_id')->unique()->count()) }}</div>
        </div>

        <div class="stat-card dark">
            <div class="stat-top">
                <div class="stat-icon">
                    <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-dot gray"></div>
            </div>
            <div class="stat-label">Total Nilai Stok</div>
            <div class="stat-value">Rp {{ number_format($buku->sum('harga_nasional') / 1000000, 1) }}M</div>
        </div>
    </div>

    {{-- CHART --}}
    <div class="chart-card">
        <div class="chart-header">
            <div>
                <div class="chart-title">Statistik Koleksi Buku</div>
                <div class="chart-subtitle">Distribusi harga buku per kategori</div>
            </div>
            <div class="chart-actions">
                <a href="{{ route('pusat.laporan.penjualan') }}" class="btn-outline">Unduh Laporan</a>
                <a href="{{ route('pusat.laporan.stok') }}" class="btn-primary">Detail Grafik</a>
            </div>
        </div>
        <div class="chart-wrap">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

{{-- JIKA DALAM MODE KELOLA DATA BUKU --}}
@else
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1>Kelola Data Buku</h1>
                <p>Manajemen data stok, kategori, dan database buku nasional pusat.</p>
            </div>
            <a href="{{ route('buku.create') }}" class="btn-primary" style="gap: 6px;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku Baru
            </a>
        </div>
    </div>
@endif

{{-- TABLE (Bagian ini akan selalu muncul pada kedua halaman) --}}
<div class="table-card" style="margin-top: 16px;">
    <div class="table-header">
        <div class="table-title">{{ ($isManagement ?? false) ? 'Semua Daftar Buku' : 'Daftar Buku Terbaru' }}</div>
        
        {{-- Tombol Lihat Semua Hanya Tampil di Beranda --}}
        @if(empty($isManagement) || $isManagement === false)
            <a href="{{ route('buku.index', ['manage' => 'true']) }}" class="lihat-semua">
                Lihat Semua
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>ISBN</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th style="text-align:right">Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Jika Kelola Buku tampilkan semua data, jika Beranda tampilkan 5 saja --}}
            @forelse(($isManagement ?? false) ? $buku : $buku->take(5) as $item)
            <tr>
                <td><span class="trx-id">#{{ $item->id }}</span></td>
                <td>
                    <div class="pelanggan-cell">
                        <div class="pelanggan-avatar">{{ strtoupper(substr($item->judul, 0, 1)) }}</div>
                        {{ $item->judul }}
                    </div>
                </td>
                <td style="color:var(--gray-400); font-size:12.5px;">{{ $item->isbn }}</td>
                <td>
                    <span class="badge badge-success">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                </td>
                <td>{{ $item->penerbit->nama_penerbit ?? '-' }}</td>
                <td class="total-col">Rp {{ number_format($item->harga_nasional, 0, ',', '.') }}</td>
                <td>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('buku.edit', $item->id) }}"
                           style="font-size:12.5px; font-weight:600; color:var(--navy); text-decoration:none; padding:5px 10px; border-radius:6px; border:1.5px solid var(--gray-200); transition:all 0.15s;"
                           onmouseover="this.style.borderColor='var(--navy)'" onmouseout="this.style.borderColor='var(--gray-200)'">
                            Edit
                        </a>
                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Hapus buku ini?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="font-size:12.5px; font-weight:600; color:var(--red); background:none; border:1.5px solid var(--gray-200); padding:5px 10px; border-radius:6px; cursor:pointer; font-family:inherit; transition:all 0.15s;"
                                onmouseover="this.style.borderColor='var(--red)'" onmouseout="this.style.borderColor='var(--gray-200)'">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:var(--gray-400); padding:32px;">
                    Belum ada data buku.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="page-footer">© {{ date('Y') }} Sistem Penjualan Buku Terdistribusi. All Rights Reserved</div>

@endsection

@push('scripts')
{{-- JIKALAU BERADA DI HALAMAN BERANDA, LOAD SCRIPT CHART --}}
@if(empty($isManagement) || $isManagement === false)
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    const bukuData = @json($buku->groupBy(fn($b) => $b->kategori->nama_kategori ?? 'Lainnya')->map(fn($g) => $g->count()));

    const labels = Object.keys(bukuData);
    const values = Object.values(bukuData);

    const ctx = document.getElementById('salesChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0, 'rgba(26, 46, 90, 0.15)');
    gradient.addColorStop(1, 'rgba(26, 46, 90, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Buku',
                data: values,
                borderColor: '#1a2e5a',
                borderWidth: 2.5,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#f5c518',
                pointBorderColor: '#1a2e5a',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a2e5a',
                    titleFont: { family: 'Plus Jakarta Sans', weight: '700', size: 13 },
                    bodyFont:  { family: 'Plus Jakarta Sans', size: 12 },
                    padding: 12,
                    cornerRadius: 10,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 12 }, color: '#9aa3be' }
                },
                y: {
                    grid: { color: '#f0f2f8', lineWidth: 1 },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 12 }, color: '#9aa3be' },
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endif
@endpush
