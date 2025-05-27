<?php
header("Content-Type: application/json");

$apiKey = "AIzaSyCSTqHIpbbMp30Vn6SlpdvPgYf2MT1RWtM"; // Reemplaza con tu clave real

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!isset($data["messages"])) {
    http_response_code(400);
    echo json_encode(["error" => "No messages provided"]);
    exit;
}

// Tomar solo el último mensaje del usuario
$userMessage = "";
foreach (array_reverse($data["messages"]) as $msg) {
    if ($msg["role"] === "user") {
        $userMessage = $msg["content"];
        break;
    }
}

if (empty($userMessage)) {
    http_response_code(400);
    echo json_encode(["error" => "No user message found"]);
    exit;
}

$payload = json_encode([
    "contents" => [[
        "parts" => [[ "text" => $userMessage ]]
    ]]
]);

$ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpCode >= 200 && $httpCode < 300) {
    $responseData = json_decode($response, true);
    $text = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "No response";
    echo json_encode([
        "choices" => [
            [ "message" => [ "content" => $text ]]
        ]
    ]);
} else {
    http_response_code($httpCode);
    echo json_encode(["error" => "Google Gemini API request failed"]);
}

curl_close($ch);
