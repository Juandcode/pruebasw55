<?php
 
  $imageUrl='https://i.ibb.co/nMtWx6n/prue.jpg';
  $ia = new IA();
  //$imageUrl = 'http://192.168.0.3:8888/pruebaazure/parcial1/public/'.$_POST['nombre'];
  //echo $imageUrl;
  $imagenJSON = $ia->getImage($imageUrl);
  //echo $imageUrl;
  echo $ia->analizarImageQr($imagenJSON, $imageUrl);
