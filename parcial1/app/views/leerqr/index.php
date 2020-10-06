<?php
require 'leerqr/vendor/autoload.php';
if (session_status() == PHP_SESSION_NONE) {
    ob_start();
    session_start();
}
$qrcode = new QrReader($_SESSION['imageUrl']);
$text = $qrcode->text();

$nonsequential = array("mesa" => $text);
echo json_encode($nonsequential);



