<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (!isset($_GET['url']) || empty($_GET['url'])) {
    echo json_encode(["ok" => false, "message" => "URL parameter tidak ditemukan"]);
    exit;
}

$targetUrl = "https://instagram-tiktok-youtube-downloader.p.rapidapi.com/fetch?url=" . urlencode($_GET['url']);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-rapidapi-host: instagram-tiktok-youtube-downloader.p.rapidapi.com",
    "x-rapidapi-key: c2add32f3emsh16710cb3366f60cp1673cfjsnb077d89c650f"
]);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(["ok" => false, "message" => "cURL Error: " . $err]);
} else {
    echo $response;
}
?>
