<?php
require '../models/IA.php';

$ia = new IA;
$imageUrl = 'https://i.ibb.co/VptGpkd/Whats-App-Image-2020-10-02-at-18-40-35.jpg';

$imagenJSON = $ia->getImage($imageUrl);
echo $ia->analizarImageQr($imagenJSON, $imageUrl);
