<?php
/**
 * Phone Router Functions
 * Helper functions for phone number validation and formatting
 */

// Function to validate phone number
function validatePhoneNumber($phone, $countryCode)
{
    $phone = preg_replace("/[^0-9]/", "", $phone);
    
    // Remove country code if it's at the beginning
    if (substr($phone, 0, strlen($countryCode)) === $countryCode) {
        $phone = substr($phone, strlen($countryCode));
    }
    
    // Check if phone number has reasonable length (7-15 digits)
    if (strlen($phone) < 7 || strlen($phone) > 15) {
        return false;
    }
    
    return $phone;
}

// Function to format phone number
function formatPhoneNumber($phone, $countryCode)
{
    $phone = preg_replace("/[^0-9]/", "", $phone);
    
    // Remove country code if it's at the beginning
    if (substr($phone, 0, strlen($countryCode)) === $countryCode) {
        $phone = substr($phone, strlen($countryCode));
    }
    
    // Format based on country code
    switch ($countryCode) {
        case '90': // Turkey
            if (strlen($phone) === 10) {
                return '+90 ' . substr($phone, 0, 3) . ' ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 2) . ' ' . substr($phone, 8, 2);
            }
            break;
        case '1': // USA/Canada
            if (strlen($phone) === 10) {
                return '+1 (' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
            }
            break;
        case '44': // UK
            if (strlen($phone) === 10) {
                return '+44 ' . substr($phone, 0, 4) . ' ' . substr($phone, 4, 3) . ' ' . substr($phone, 7, 3);
            }
            break;
        default:
            return '+' . $countryCode . ' ' . $phone;
    }
    
    return '+' . $countryCode . ' ' . $phone;
}

// Simple analytics function
function logClick($phone)
{
    $logFile = 'data/analytics.txt';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    $logEntry = "$timestamp | $phone | $ip | $userAgent\n";
    
    // Create data directory if it doesn't exist
    $dataDir = dirname($logFile);
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    // Append to log file (create if doesn't exist)
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Function to get country name from code
function getCountryName($countryCode) {
    $countries = [
        '90' => 'Türkiye',
        '1' => 'ABD/Kanada',
        '44' => 'İngiltere',
        '49' => 'Almanya',
        '33' => 'Fransa',
        '39' => 'İtalya',
        '34' => 'İspanya',
        '31' => 'Hollanda',
        '32' => 'Belçika',
        '46' => 'İsveç',
        '47' => 'Norveç',
        '45' => 'Danimarka',
        '358' => 'Finlandiya',
        '48' => 'Polonya',
        '420' => 'Çek Cumhuriyeti',
        '36' => 'Macaristan',
        '40' => 'Romanya',
        '359' => 'Bulgaristan',
        '30' => 'Yunanistan',
        '351' => 'Portekiz'
    ];
    
    return $countries[$countryCode] ?? 'Bilinmeyen';
}

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Function to validate country code
function validateCountryCode($countryCode) {
    $validCodes = ['90', '1', '44', '49', '33', '39', '34', '31', '32', '46', '47', '45', '358', '48', '420', '36', '40', '359', '30', '351'];
    return in_array($countryCode, $validCodes);
}
?> 