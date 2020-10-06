<?php
class Recinto{
    public $id;
    public $nombre;
    public $idDistrito;

    public function __construct($id,$nombre,$idDistrito)
    { 
        $this->id=$id;
        $this->nombre=$nombre;
        $this->idDistrito=$idDistrito;
    }
    public static function getRecintos()
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM recinto';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Recinto($tabla['id'], $tabla['nombre'], $tabla['idDistrito']);
        }

        return $list;
    }
    public static function getNombreDistrito($id)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM recinto where id="'.$id.'"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Recinto($tabla['id'], $tabla['nombre'], $tabla['idDistrito']);
        }

        return $list[0]->nombre;
    }
}