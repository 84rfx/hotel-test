<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "=== SECURITY QUESTIONS DATABASE CHECK ===\n\n";

try {
    // Check total users
    $totalUsers = User::count();
    echo "Total users in database: $totalUsers\n\n";

    // Check users with security questions
    $usersWithQuestions = User::whereNotNull('security_question')->count();
    echo "Users with security questions: $usersWithQuestions\n\n";

    // Show sample users with security questions
    $users = User::whereNotNull('security_question')->take(5)->get();

    if ($users->count() > 0) {
        echo "Sample users with security questions:\n";
        foreach ($users as $user) {
            echo "- Email: {$user->email}\n";
            echo "  Question: {$user->security_question}\n";
            echo "  Answer: " . (strlen($user->security_answer) > 0 ? "[SET]" : "[EMPTY]") . "\n\n";
        }
    } else {
        echo "No users found with security questions set.\n\n";
    }

    // Check if migration has been run by checking table structure
    $columns = \Illuminate\Support\Facades\Schema::getColumnListing('users');
    $hasSecurityQuestion = in_array('security_question', $columns);
    $hasSecurityAnswer = in_array('security_answer', $columns);

    echo "Database schema check:\n";
    echo "- security_question column exists: " . ($hasSecurityQuestion ? "YES" : "NO") . "\n";
    echo "- security_answer column exists: " . ($hasSecurityAnswer ? "YES" : "NO") . "\n\n";

} catch (Exception $e) {
    echo "Error checking database: " . $e->getMessage() . "\n";
}
