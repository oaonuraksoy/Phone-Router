<?php
// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Type: application/json");

// Include functions
require_once '../includes/functions.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['phone'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

// Validate phone number
$phone = preg_replace("/[^0-9+]/", "", $input['phone']);
if (empty($phone)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid phone number']);
    exit;
}

// Get additional data
$timestamp = $input['timestamp'] ?? date('Y-m-d H:i:s');
$userAgent = $input['userAgent'] ?? 'unknown';
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Check for duplicate entries (within last 5 seconds from same IP)
$logFile = '../data/analytics.txt';
$dataDir = dirname($logFile);

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Check for recent duplicate
if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $recentTime = date('Y-m-d H:i:s', strtotime('-5 seconds'));
    
    foreach ($lines as $line) {
        $parts = explode(' | ', $line);
        if (count($parts) >= 4) {
            $logTimestamp = $parts[0];
            $logPhone = $parts[1];
            $logIp = $parts[2];
            
            // Check if same phone, IP, and within 5 seconds
            if ($logPhone === $phone && $logIp === $ip && $logTimestamp >= $recentTime) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Duplicate entry prevented',
                    'phone' => $phone,
                    'timestamp' => $timestamp
                ]);
                exit;
            }
        }
    }
}

// Log the click
$logEntry = "$timestamp | $phone | $ip | $userAgent\n";

// Append to log file with file locking
if (file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) !== false) {
    echo json_encode([
        'success' => true,
        'message' => 'Click tracked successfully',
        'phone' => $phone,
        'timestamp' => $timestamp
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to log click']);
}
?> 