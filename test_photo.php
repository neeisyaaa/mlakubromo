<?php
// Test file to debug profile photo issue
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Get user data
$user = App\Models\User::find(1);

echo "=== PROFILE PHOTO DEBUG ===\n";
echo "User ID: " . $user->id . "\n";
echo "User Name: " . $user->name . "\n";
echo "Profile Photo from DB: " . ($user->profile_photo ?? 'NULL') . "\n";

if ($user->profile_photo) {
    $filename = basename($user->profile_photo);
    $fullPath = public_path('images/profile_photos/' . $filename);
    
    echo "Filename: " . $filename . "\n";
    echo "Full Path: " . $fullPath . "\n";
    echo "File Exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . "\n";
    echo "Asset URL: " . asset('images/profile_photos/' . $filename) . "\n";
    
    if (file_exists($fullPath)) {
        echo "File Size: " . filesize($fullPath) . " bytes\n";
        echo "File Type: " . mime_content_type($fullPath) . "\n";
    }
}

echo "=== END DEBUG ===\n";
?>
