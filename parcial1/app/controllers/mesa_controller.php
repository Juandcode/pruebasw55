<?php
class mesaController
{
    public function index(){
        require_once('../app/views/mesa/index.php');
    }
    public function getidMesa()
    {
      //if (isset($_POST['codigoqr'])) {
            //$codigo = $_POST['codigoqr'];
            $datos1 = mesa::getID(111);
            $datos = json_encode($datos1);
           
            echo $datos1;
        /*} else {
            echo "error";
        }*/
    }
    public function votosMesaExiste(){
        $votada=Votos::mesayaVotada(1);
        echo $votada;
    }
    public function getMesas()
    {

        //$codigo = $_POST['codigoqr'];
        $datos1 = mesa::getMesas();
        $datos = json_encode($datos1);
       
        echo $datos;
    }
    public function datosVotosMesa(){
        $d=Votos::devolverDatos(1);
        echo json_encode($d);
    }
    public function resultados(){
        if(isset($_POST['id'])){
            if (session_status() == PHP_SESSION_NONE) {
                ob_start();
                session_start();
            }
            $_SESSION['mesaactual']= $_POST['id'];
            $_SESSION['resultadosMesa']=Votos::devolverDatos($_POST['id']);
            $resmesa=$_SESSION['resultadosMesa'];
            foreach ($resmesa as $key => $value) {
                echo $value->cantidad."\n";
            }
            //echo json_encode($_SESSION['resultadosMesa']);
            require_once('../app/views/mesa/resultado.php');
            
        }
    }
}
