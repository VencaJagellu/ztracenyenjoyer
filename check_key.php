<?php
header('Content-Type: application/json');

$apiKey = 'AIzaSyDUdycqQ6AbLvjKSi_rr4Pm2zql-EBIns0';
// Try to list models to see if the key works and what models are available
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['error' => 'Key Validation Failed', 'code' => $httpCode, 'details' => json_decode($response, true) ?: $response]);
} else {
    echo json_encode(['success' => 'Key is valid', 'models' => json_decode($response, true)]);
}
