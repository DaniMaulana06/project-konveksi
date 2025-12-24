<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class NavbarCuacaComposer
{
    /**
     * Kirim data cuaca ke navbar
     */
    public function compose(View $view): void
    {
        $kota = 'Palembang';

        try {
            /**
             * 1. Ambil koordinat kota
             */
            $geoResponse = Http::timeout(5)->get(
                'https://geocoding-api.open-meteo.com/v1/search',
                ['name' => $kota]
            );

            if (!$geoResponse->successful()) {
                $view->with('cuacaNavbar', null);
                return;
            }

            $geo = $geoResponse->json();

            if (!isset($geo['results'][0])) {
                $view->with('cuacaNavbar', null);
                return;
            }

            $lat = $geo['results'][0]['latitude'];
            $lon = $geo['results'][0]['longitude'];

            /**
             * 2. Ambil data cuaca berdasarkan koordinat
             */
            $cuacaResponse = Http::timeout(5)->get(
                'https://api.open-meteo.com/v1/forecast',
                [
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'current_weather' => true,
                ]
            );

            if (!$cuacaResponse->successful()) {
                $view->with('cuacaNavbar', null);
                return;
            }

            $cuaca = $cuacaResponse->json();

            /**
             * 3. Kirim data ke view (INILAH ASAL VARIABEL $cuacaNavbar)
             */
            $view->with('cuacaNavbar', [
                'kota' => $kota,
                'suhu' => $cuaca['current_weather']['temperature'] ?? '-',
            ]);

        } catch (\Throwable $e) {
            // Jika API error / timeout, halaman tetap aman
            $view->with('cuacaNavbar', null);
        }
    }
}