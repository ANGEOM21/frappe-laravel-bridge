<?php

namespace Angeom\FrappeBridge;

use Illuminate\Support\Facades\Http;
use Exception;

class FrappeBridge
{
    protected $pathPrefix;

    public function __construct($pathPrefix = '')
    {
        $this->pathPrefix = $pathPrefix;
    }

    public function __get($name)
    {
        $newPath = $this->pathPrefix ? "{$this->pathPrefix}.{$name}" : $name;
        return new self($newPath);
    }

    public function __call($name, $arguments)
    {
        $path = $this->pathPrefix ? "{$this->pathPrefix}.{$name}" : $name;
        
        $args = [];
        $kwargs = [];
        
        $lastArg = end($arguments);
        if (is_array($lastArg) && array_keys($lastArg) !== range(0, count($lastArg) - 1)) {
            $kwargs = array_pop($arguments);
        }
        $args = $arguments;

        $url = config('frappe.url');
        $proxyPath = config('frappe.proxy_path');
        $apiKey = config('frappe.api_key');
        $apiSecret = config('frappe.api_secret');

        if (!$apiKey || !$apiSecret) {
            throw new Exception("Frappe Bridge Error: API Key and API Secret must be set in config/frappe.php or .env");
        }

        $response = Http::withHeaders([
            'Authorization' => "token {$apiKey}:{$apiSecret}",
            'Accept'        => 'application/json'
        ])->post("{$url}/api/method/{$proxyPath}", [
            'path'   => $path,
            'args'   => $args,
            'kwargs' => $kwargs
        ]);

        if ($response->failed()) {
            throw new Exception("Frappe Bridge Error: " . $response->body());
        }

        return $response->json('message');
    }
}
