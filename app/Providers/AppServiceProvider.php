<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $notifikasiPengaduan = collect();
            $totalNotifikasi = 0;

            if (auth()->check()) {
                $user = auth()->user();

                $query = \App\Models\Pengaduan::with('jurusan')
                    ->where('status', 'Proses')
                    ->latest();

                if ($user->role !== 'super_admin') {
                    $query->where('jurusan_id', $user->jurusan_id);
                }

                $totalNotifikasi = $query->count();
                $notifikasiPengaduan = $query->take(3)->get();
            }

            $view->with([
                'notifikasiPengaduan' => $notifikasiPengaduan,
                'totalNotifikasi' => $totalNotifikasi
            ]);
        });
    }
}
