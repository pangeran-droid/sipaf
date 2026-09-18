@extends('layouts.public')

@section('content')

<section style="padding: 76px 0 90px;">
    <div class="wrap" style="max-width: 1200px;">

        {{-- Section Header --}}
        <div style="margin-bottom: 50px; text-align: center;">
            <div class="hero-eyebrow">MONITORING PUBLIK</div>
            <h1 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 14px;">Antrian Pengaduan</h1>
            <p style="color: var(--ink-soft); font-size: 16px; max-width: 55ch; margin: 0 auto;">
                Pantau proses penanganan pengaduan akademik secara transparan melalui status pengaduan berikut.
            </p>
        </div>

        {{-- Filter Box --}}
        <div style="margin-bottom: 50px;">
            <form id="filter-form" method="GET" action="{{ route('pengaduan.antrian') }}">
                <div style="background: var(--white); border: 1px solid var(--line); padding: 28px; box-shadow: 6px 6px 0 rgba(22,35,58,0.03);">

                    <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 0.6fr; gap: 20px; align-items: end;">

                        {{-- Search / Kode Pengaduan --}}
                        <div>
                            <label for="search" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                                Kode Pengaduan
                            </label>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Contoh: ADU-20260913-0001"
                                style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none;"
                            >
                        </div>

                        {{-- Jurusan --}}
                        {{-- <div>
                            <label for="jurusan_id" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                                Jurusan Terkait
                            </label>
                            <select
                                id="jurusan_id"
                                name="jurusan_id"
                                style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none;"
                            >
                                <option value="">Semua Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

                        {{-- Button Filter --}}
                        <div>
                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 14.5px; text-align: center;">
                                Filter Data
                            </button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
        {{-- End Filter --}}


        {{-- Kanban Layout (3 Kolom) --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; align-items: start;">

            {{-- PROSES --}}
            <div class="kanban-column">

                {{-- Header --}}
                <div class="kanban-header proses">
                    <div>
                        <span class="status-icon"><i class="fa-solid fa-hourglass-start"></i></span>
                        <div>
                            <h4>Proses</h4>
                            <span>Menunggu penanganan</span>
                        </div>
                    </div>
                    <span class="status-count">{{ $prosesTotal }}</span>
                </div>

                {{-- Body --}}
                <div class="kanban-body">
                    @forelse($proses as $item)
                        <div class="complaint-card">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                <span class="complaint-code">{{ $item->kode_pengaduan }}</span>
                                <span style="font-size: 12px; font-family: var(--mono); color: var(--gold-deep); font-weight: 600;">PROSES</span>
                            </div>
                            {{-- <h5 style="font-family: var(--serif); font-size: 16px; font-weight: 600; color: var(--ink); margin-bottom: 12px;">
                                {{ $item->jurusan->nama_jurusan }}
                            </h5> --}}
                            <div class="complaint-info">
                                {{-- <div><strong style="color: var(--ink-faint);">Dosen:</strong> {{ $item->nama_dosen }}</div> --}}
                                <div><strong style="color: var(--ink-faint);">Tanggal:</strong> {{ $item->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Tidak ada pengaduan dalam status proses.</p>
                        </div>
                    @endforelse

                    @if($prosesTotal > 5)
                        <div class="more-complaints">
                            <span>+{{ $prosesTotal - 5 }} pengaduan lainnya</span>
                        </div>
                    @endif
                </div>

            </div>


            {{-- SEDANG DITANGANI --}}
            <div class="kanban-column">

                {{-- Header --}}
                <div class="kanban-header ditangani">
                    <div>
                        <span class="status-icon"><i class="fa-solid fa-gears"></i></span>
                        <div>
                            <h4>Sedang Ditangani</h4>
                            <span>Dalam proses penindakan</span>
                        </div>
                    </div>
                    <span class="status-count">{{ $sedangDitanganiTotal }}</span>
                </div>

                {{-- Body --}}
                <div class="kanban-body">
                    @forelse($sedangDitangani as $item)
                        <div class="complaint-card">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                <span class="complaint-code">{{ $item->kode_pengaduan }}</span>
                                <span style="font-size: 12px; font-family: var(--mono); color: #B3863C; font-weight: 600;">DITANGANI</span>
                            </div>
                            {{-- <h5 style="font-family: var(--serif); font-size: 16px; font-weight: 600; color: var(--ink); margin-bottom: 12px;">
                                {{ $item->jurusan->nama_jurusan }}
                            </h5> --}}
                            <div class="complaint-info">
                                {{-- <div><strong style="color: var(--ink-faint);">Dosen:</strong> {{ $item->nama_dosen }}</div> --}}
                                <div><strong style="color: var(--ink-faint);">Tanggal:</strong> {{ $item->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Tidak ada pengaduan sedang ditangani.</p>
                        </div>
                    @endforelse

                    @if($sedangDitanganiTotal > 5)
                        <div class="more-complaints">
                            <span>+{{ $sedangDitanganiTotal - 5 }} pengaduan lainnya</span>
                        </div>
                    @endif
                </div>

            </div>


            {{-- SELESAI --}}
            <div class="kanban-column">

                {{-- Header --}}
                <div class="kanban-header selesai">
                    <div>
                        <span class="status-icon">✓</span>
                        <div>
                            <h4>Selesai</h4>
                            <span>Pengaduan tuntas ditangani</span>
                        </div>
                    </div>
                    <span class="status-count">{{ $selesaiTotal }}</span>
                </div>

                {{-- Body --}}
                <div class="kanban-body">
                    @forelse($selesai as $item)
                        <div class="complaint-card">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                <span class="complaint-code">{{ $item->kode_pengaduan }}</span>
                                <span style="font-size: 12px; font-family: var(--mono); color: #4B7A54; font-weight: 600;">SELESAI</span>
                            </div>
                            {{-- <h5 style="font-family: var(--serif); font-size: 16px; font-weight: 600; color: var(--ink); margin-bottom: 12px;">
                                {{ $item->jurusan->nama_jurusan }}
                            </h5> --}}
                            <div class="complaint-info">
                                {{-- <div><strong style="color: var(--ink-faint);">Dosen:</strong> {{ $item->nama_dosen }}</div> --}}
                                <div><strong style="color: var(--ink-faint);">Tanggal:</strong> {{ $item->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Tidak ada pengaduan selesai.</p>
                        </div>
                    @endforelse

                    @if($selesaiTotal > 5)
                        <div class="more-complaints">
                            <span>+{{ $selesaiTotal - 5 }} pengaduan lainnya</span>
                        </div>
                    @endif
                </div>

            </div>

        </div>
        {{-- End Kanban --}}

    </div>
</section>

@endsection
