<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pengadu' => ['required', 'string', 'max:255'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'isi_pengaduan' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pengadu.required' => 'Nama pengadu wajib diisi.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'nama_dosen.required' => 'Nama dosen terkait wajib diisi.',
            'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
            'isi_pengaduan.min' => 'Isi pengaduan minimal 10 karakter.',
            'isi_pengaduan.max' => 'Isi pengaduan maksimal 2000 karakter.',
        ];
    }
}