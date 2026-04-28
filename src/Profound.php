<?php

namespace Astrogoat\Profound;

use Astrogoat\Profound\Settings\ProfoundSettings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Profound
{
    protected string $baseUrl;
    protected bool $enabled;
    protected ?string $apiKey;

    public function __construct()
    {
        $settings = app(ProfoundSettings::class);

        $this->baseUrl = config('profound.base_url');
        $this->apiKey = $settings->api_key ?? null;
        $this->enabled = $settings->enabled ?? false;
    }

    public function sendCustomAnalytics(array $payload): ?array
    {
        if (! $this->enabled || blank($this->apiKey)) {
            return null;
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ])
                ->baseUrl($this->baseUrl)
                ->post('/logs/custom', $payload);

            if (! $response->successful()) {
                Log::warning('Profound analytics request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            return $response->json();
        } catch (\Throwable $e) {
            Log::error('Profound analytics error', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
