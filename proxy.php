<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['error' => 'No message provided']);
    exit;
}

$apiKey = 'AIzaSyDUdycqQ6AbLvjKSi_rr4Pm2zql-EBIns0';
// Reverting to the most standard model for compatibility
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => "Jsi zpěvák Marek Ztracený. Buď ultra-stručný (max 1 věta), přátelský a milý. Nepřemýšlej nahlas, rovnou odpověz fanouškovi: " . $userMessage]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7,
        "maxOutputTokens" => 400,
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode([
        'error' => 'API Error',
        'code' => $httpCode,
        'details' => json_decode($response, true) ?: $response
    ]);
    exit;
}

$result = json_decode($response, true);

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $aiText = $result['candidates'][0]['content']['parts'][0]['text'];
    echo json_encode(['response' => trim($aiText)]);
} else {
    echo json_encode([
        'error' => 'No response content',
        'details' => $result
    ]);
}
