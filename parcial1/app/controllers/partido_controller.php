<?php
class PartidoController{
    public function index(){
        require_once('../app/views/partido/index.php');
    }
    public function getPartidos1(){
        $datos = Partido::getPartidos();
        $f = json_encode($datos);
        $arr=[];
        $parte1=json_decode($datos,true);
        foreach($datos as $key=>$value){
            array_push($arr,$value->nombre);
        }
        
        echo json_encode($arr);
    }
    public function getidpartido(){
        $pa=Partido::getID("UCS");
        echo $pa;
    }

}
