<?php

header("Content-Type: application/json");

require_once __DIR__ . "/../aiconfig/aiconfig.php";

$data = json_decode(file_get_contents("php://input"), true);

$message = trim($data["message"] ?? "");
 
if ($message == "") {
    http_response_code(400);
    echo json_encode(["error" => "Please enter a message."]);
    exit;
}

if ($apiKey === false || $apiKey === "") {
    http_response_code(500);
    echo json_encode(["error" => "The Gemini API key is not configured in aiconfig.php."]);
    exit;
}

$prompt = "
You are Travel Mate AI, a helpful travel assistant.
Answer questions related to travel in Sri Lanka.
Give simple, friendly and useful travel information.
If you are unsure about something, say so.
Do not invent exact prices, opening hours or travel conditions.

Traveler question: $message
";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent";

$body = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
        ]
    ]
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_TIMEOUT, 90);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-goog-api-key: " . $apiKey
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

$response = curl_exec($ch);

if ($response === false) {
    $curlError = curl_error($ch);
    $curlErrorNumber = curl_errno($ch);
    error_log("Gemini request failed (cURL " . $curlErrorNumber . "): " . $curlError);
    curl_close($ch);
    http_response_code(502);
    $errorMessage = $curlErrorNumber === CURLE_OPERATION_TIMEDOUT
        ? "Gemini took too long to respond. Please try again."
        : "Unable to reach Gemini. Check the server connection and try again.";
    echo json_encode(["error" => $errorMessage]);
    exit;
}

$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);

if ($statusCode < 200 || $statusCode >= 300) {
    error_log("Gemini API returned HTTP " . $statusCode);
    http_response_code(502);
    echo json_encode([
        "error" => $result["error"]["message"] ?? "Gemini returned an error. Check the API key and model access."
    ]);
    exit;
}

$reply = $result["candidates"][0]["content"]["parts"][0]["text"]
         ?? "Sorry, I couldn't generate a response.";

echo json_encode(["reply" => $reply]);

?>