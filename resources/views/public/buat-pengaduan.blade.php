@extends('layouts.public')

@section('content')

<section style="padding: 76px 0 90px;">
    <div class="wrap" style="max-width: 800px;">

        <div style="margin-bottom: 40px; text-align: center;">
            <div class="hero-eyebrow">FORMULIR RESMI</div>
            <h1 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 14px;">Buat Pengaduan Akademik</h1>
            <p style="color: var(--ink-soft); font-size: 16px; max-width: 50ch; margin: 0 auto;">
                Sampaikan pengaduan akademik Anda dengan jelas dan lengkap. Kami akan menindaklanjuti setiap pengaduan yang masuk.
            </p>
        </div>

        <div style="background: var(--white); border: 1px solid var(--line); padding: 40px 36px; box-shadow: 6px 6px 0 rgba(22,35,58,0.04);">

            @if(session('success'))
                <div style="background: #EAF3EC; border: 1px solid #B8D6BE; color: #2C5634; padding: 14px 18px; margin-bottom: 28px; font-size: 14px; display: flex; align-items: flex-start; gap: 10px;">
                    <span style="font-weight: 600; font-family: var(--mono);">[BERHASIL]</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div style="background: #FDF2F2; border: 1px solid #E5C3C3; color: var(--maroon); padding: 14px 18px; margin-bottom: 28px; font-size: 14px; display: flex; align-items: flex-start; gap: 10px;">
                    <span style="font-weight: 600; font-family: var(--mono);">[PERHATIAN]</span>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div style="background: #FDF2F2; border: 1px solid #E5C3C3; color: var(--maroon); padding: 16px 18px; margin-bottom: 28px; font-size: 14px;">
                    <div style="font-weight: 600; margin-bottom: 8px; font-family: var(--sans);">
                        Terdapat kesalahan pada pengisian form:
                    </div>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li style="margin-bottom: 4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; gap: 24px;">

                    <div>
                        <label for="nama_pengadu" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                            Nama Pengadu <span style="color: var(--maroon);">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_pengadu"
                            id="nama_pengadu"
                            value="{{ old('nama_pengadu') }}"
                            placeholder="Masukkan nama lengkap Anda"
                            required
                            style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none; transition: border-color 0.15s ease;"
                            onfocus="this.style.borderColor='var(--ink)'"
                            onblur="this.style.borderColor='var(--line)'"
                        >
                        @error('nama_pengadu')
                            <div style="color: var(--maroon); font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="jurusan_id" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                            Jurusan Pengadu <span style="color: var(--maroon);">*</span>
                        </label>
                        <select
                            name="jurusan_id"
                            id="jurusan_id"
                            required
                            style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none; transition: border-color 0.15s ease;"
                            onfocus="this.style.borderColor='var(--ink)'"
                            onblur="this.style.borderColor='var(--line)'"
                        >
                            <option value="" disabled {{ old('jurusan_id') ? '' : 'selected' }}>
                                -- Pilih Jurusan --
                            </option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div style="color: var(--maroon); font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_dosen" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                            Nama Dosen Terkait <span style="color: var(--maroon);">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_dosen"
                            id="nama_dosen"
                            value="{{ old('nama_dosen') }}"
                            placeholder="Masukkan nama dosen yang bersangkutan"
                            required
                            style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none; transition: border-color 0.15s ease;"
                            onfocus="this.style.borderColor='var(--ink)'"
                            onblur="this.style.borderColor='var(--line)'"
                        >
                        @error('nama_dosen')
                            <div style="color: var(--maroon); font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="isi_pengaduan" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                            Isi Pengaduan <span style="color: var(--maroon);">*</span>
                        </label>
                        <textarea
                            name="isi_pengaduan"
                            id="isi_pengaduan"
                            rows="7"
                            placeholder="Tuliskan detail pengaduan akademik Anda di sini..."
                            required
                            style="width: 100%; padding: 12px 14px; font-family: var(--sans); font-size: 14.5px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none; resize: vertical; transition: border-color 0.15s ease;"
                            onfocus="this.style.borderColor='var(--ink)'"
                            onblur="this.style.borderColor='var(--line)'"
                        >{{ old('isi_pengaduan') }}</textarea>

                        @error('isi_pengaduan')
                            <div style="color: var(--maroon); font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                        @enderror

                        <div style="font-size: 12.5px; color: var(--ink-faint); margin-top: 6px; font-family: var(--mono);">
                            * Sampaikan pengaduan dengan bahasa yang sopan dan jelas (Minimal 10 karakter).
                        </div>
                    </div>

                    <div>
                        <label for="lampiran" style="display: block; font-family: var(--sans); font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 8px;">
                            Lampiran Bukti (Opsional)
                        </label>
                        <input
                            type="file"
                            name="lampiran"
                            id="lampiran"
                            accept=".jpg,.jpeg,.png,.pdf"
                            style="width: 100%; padding: 10px 14px; font-family: var(--sans); font-size: 14px; border: 1px solid var(--line); border-radius: var(--radius-doc); background: var(--paper); color: var(--ink); outline: none;"
                        >
                        @error('lampiran')
                            <div style="color: var(--maroon); font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                        @enderror
                        <div style="font-size: 12.5px; color: var(--ink-faint); margin-top: 6px; font-family: var(--mono);">
                            * Format yang didukung: JPG, JPEG, PNG, atau PDF. Ukuran maksimal 2MB.
                        </div>
                    </div>

                    <div style="margin-top: 10px; text-align: center; border-top: 1px dashed var(--line); padding-top: 30px;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 15px; font-weight: 600;">
                            Kirim Pengaduan Sekarang
                        </button>

                        <div style="margin-top: 16px; font-size: 13px; color: var(--ink-faint); display: flex; align-items: center; justify-content: center; gap: 6px;">
                            <span class="dot" style="background: var(--gold);"></span> Data pengaduan diproses secara aman dan rahasia.
                        </div>
                    </div>

                </div>
            </form>

        </div>

    </div>
</section>

@endsection
