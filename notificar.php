<?php
// Configuración
$token = '6159424723:AAE4qhm6H4sNLztr5HnLjAOrZlf95BAUKBE';
$channelId = "-1003508204208";

// Datos del visitante
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Mensaje
$message = "👻 *NUEVO INGRESO* 👻\n\n"; 

$data = [
    'chat_id' => $channelId,
    'text' => $message,
    'parse_mode' => 'Markdown'
];

// Envío cURL
$ch = curl_init("https://api.telegram.org/bot$token/sendMessage");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

// --- ESTAS LÍNEAS SON CLAVE SI NO NOTIFICA ---
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignora errores de certificado SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

$response = curl_exec($ch);
$error = curl_error($ch); // Captura el error si existe
curl_close($ch);

// Esto te ayudará a ver qué pasa si lo abres directo en el navegador
if ($error) {
    echo "Error de cURL: " . $error;
} else {
    echo "Respuesta de Telegram: " . $response;
}
?>