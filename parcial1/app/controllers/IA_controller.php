<?php


class IAController
{

    public function analizarImagen()
    {
        //  if (isset($_POST['nombre'])) {
        $imageUrl = 'https://i.ibb.co/nMtWx6n/prue.jpg';
        $ia = new IA();
        //$imageUrl = 'http://diegoswparcial.000webhostapp.com/parcial1/public/'.$_POST['nombre'];
        //echo $imageUrl;
        $imagenJSON = $ia->getImage($imageUrl);
        //echo $imageUrl;
            echo $imageUrl;
        /*$resultados = json_encode($ia->analizarImageQr($imagenJSON, $imageUrl));
        $loop = json_decode($resultados, true);
        foreach ($loop['resultados'] as $key => $value) {
            //echo $key;
        }
        $this->guardarVotos($resultados);
        echo $resultados;*/
        /*  } else {
            echo json_encode("error");
        }*/
    }
    public function guardarVotos($jsonarray)
    {
        //if(isset($_POST['datosJSON'])){
        $datoss = $jsonarray;
        //$datoss = '{"resultados":{"UCS":15,"MAS":5,"UDN":3,"NULO":1,"BLANCO":2,"MESA":1}}';
        $loop = json_decode($datoss, true);
        $codigoqr = $loop['resultados']['MESA'];
        $idMesa = mesa::getID($codigoqr);
        if ($loop['resultados']!='error') {
            foreach ($loop['resultados'] as $key => $value) {
                if ($key != 'MESA') {
                    $idPartido = Partido::getID($key);
                    $res = Votos::guardar($idPartido, $idMesa, $value);
                    //echo "ipartido: " . $idPartido . " idmesa: " . $idMesa . " cantidad:" . $value . "\n";
                }
            }
        }
        //}
    }
    public function guardar1()
    {
        if (isset($_POST['image']) && isset($_POST['name'])) {
            if (session_status() == PHP_SESSION_NONE) {
                ob_start();
                session_start();
            }

            $image = $_POST['image'];
            $name = $_POST['name'];
            $_SESSION['imgurrr'] = 'http://192.168.0.3:8888/pruebaazure/parcial1/public/' . $name;

            $realImage = base64_decode($image);
            file_put_contents($name, $realImage);
            echo $_SESSION['imgurrr'];
        } else {
            echo 'problemas';
        }
    }
}
