# Frappe Laravel Bridge

A seamless bridge to connect your Laravel application with Frappe/ERPNext Python backend.
This package allows you to call any Python method inside Frappe directly from Laravel using PHP magic methods.

## Installation

Since this package is in development, add it locally to your Laravel project's `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "path/to/frappe-laravel-bridge"
    }
]
```

Then run:
```bash
composer require angeom21/frappe-laravel-bridge @dev
```

Publish the configuration file:
```bash
php artisan vendor:publish --tag="frappe-config"
```

## Configuration

Update your `.env` file with your Frappe Administrator API credentials:

```env
FRAPPE_URL=http://your-frappe-server.local:8000
FRAPPE_API_KEY=your_api_key
FRAPPE_API_SECRET=your_api_secret
```

## Usage

Use the `Frappe` facade to call native Frappe methods or your custom app methods!

```php
use Angeom\FrappeBridge\Facades\Frappe;

class ExampleController extends Controller 
{
    public function index() 
    {
        // Example 1: Calling standard frappe methods
        $user = Frappe::get_doc("User", "Administrator");
        
        // Example 2: Calling frappe methods with keyword arguments (kwargs)
        $accounts = Frappe::get_all("Account", [
            "filters" => ["is_group" => 0],
            "fields" => ["name", "account_type"]
        ]);

        // Example 3: Calling your custom app functions
        // Mapped to Python: your_app.your_file.your_function(arg1, arg2)
        $result = Frappe::your_app->your_file->your_function("Argument 1", "Argument 2");
        
        return response()->json($result);
    }
}
```

## License

MIT License
