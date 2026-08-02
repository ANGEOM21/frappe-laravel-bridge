<?php

return [
    'url' => env('FRAPPE_URL', 'http://127.0.0.1:8000'),
    'api_key' => env('FRAPPE_API_KEY', ''),
    'api_secret' => env('FRAPPE_API_SECRET', ''),
    'proxy_path' => env('FRAPPE_PROXY_PATH', 'frappe_node_bridge.api.bridge.execute_proxy'),
];
