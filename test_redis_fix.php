<?php
// Test script to verify Redis configuration fix
require_once 'vendor/autoload.php';

// Load Laravel environment
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Test if Redis facade is available
    echo "Testing Redis facade availability...\n";

    // This should work now with predis
    $redis = app('redis');
    echo "✅ Redis facade loaded successfully\n";
    echo "✅ Using client: " . config('database.redis.client') . "\n";

    // Test basic connection (will fail if Redis server not running, but won't throw class not found)
    try {
        $redis->ping();
        echo "✅ Redis server connection successful\n";
    } catch (Exception $e) {
        echo "⚠️  Redis server not running (expected): " . $e->getMessage() . "\n";
        echo "✅ But Redis class is now available (main issue fixed)\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
