<?php
class JuradoController{
    public function index(){
        require_once('../app/views/jurado/index.php');
    }
    public function guardar(){
        if(isset($_POST['nombre'])&& isset($_POST['email'])&& isset($_POST['clave'])){
            $nombre=$_POST['nombre'];
            $email=$_POST['email'];
            $clave=$_POST['clave'];
            $req=login::guardar($nombre,$email,$clave);
            if($req){
                require_once('../app/views/jurado/index.php');
            }else{

            }
        }else{
            echo 'error';
        }

    }
}
