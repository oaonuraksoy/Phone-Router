<?php
// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Type: application/json");

// Function to get analytics data
function getAnalytics() {
    $logFile = '../data/analytics.txt';
    
    if (!file_exists($logFile)) {
        return [
            'totalClicks' => 0,
            'todayClicks' => 0,
            'recentClicks' => []
        ];
    }
    
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $totalClicks = count($lines);
    $todayClicks = 0;
    $recentClicks = [];
    
    $today = date('Y-m-d');
    
    foreach ($lines as $line) {
        $parts = explode(' | ', $line);
        if (count($parts) >= 4) {
            $timestamp = $parts[0];
            $phone = $parts[1];
            $ip = $parts[2];
            
            // Check if click was today
            if (strpos($timestamp, $today) === 0) {
                $todayClicks++;
            }
            
            // Get last 10 clicks
            if (count($recentClicks) < 10) {
                $recentClicks[] = [
                    'timestamp' => $timestamp,
                    'phone' => $phone,
                    'ip' => $ip
                ];
            }
        }
    }
    
    return [
        'totalClicks' => $totalClicks,
        'todayClicks' => $todayClicks,
        'recentClicks' => array_reverse($recentClicks) // Most recent first
    ];
}

// Return analytics data as JSON
echo json_encode(getAnalytics());
?> 