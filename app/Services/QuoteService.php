<?php
// app/Services/QuoteService.php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuoteService
{
    /**
     * Cache key + TTL (seconds)
     */
    private const CACHE_KEY = 'random_quote';
    private const CACHE_TTL = 600;   // 10 minutes

    public function getRandomQuote(): array
    {
        // Return cached quote if it exists
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->fetchFromApi();
        });
    }

    /**
     * Force a fresh quote (bypasses cache)
     */
    public function refreshQuote(): array
    {
        Cache::forget(self::CACHE_KEY);

        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->fetchFromApi();
        });
    }

    private function fetchFromApi(): array
    {
        try {
            $response = Http::timeout(5)->get('https://zenquotes.io/api/random');

            if ($response->successful()) {
                $data = $response->json()[0] ?? null;

                if ($data) {
                    return [
                        'text' => $data['q'],
                        'author' => $data['a'],
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to fetch random quote: ' . $e->getMessage());
        }

        return [
            'text' => 'Education is the most powerful weapon which you can use to change the world.',
            'author' => 'Nelson Mandela',
        ];
    }
}