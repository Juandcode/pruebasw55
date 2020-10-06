<?php
class Partido{
    public $id;
    public $nombre;
    public $presidente;
    public $vicepresidente;
    public function __construct($id,$nombre,$presidente,$vicepresidente)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->presidente=$presidente;
        $this->vicepresidente=$vicepresidente;
    }
    public static function getPartidos()
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM partido';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Partido($tabla['id'], $tabla['nombre'], $tabla['presidente'], $tabla['vicepresidente']);
        }

        return $list;
    }
    public static function getID($nombre)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM partido WHERE nombre="'.$nombre.'"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Partido($tabla['id'], $tabla['nombre'], $tabla['presidente'], $tabla['vicepresidente']);
        }

        return $list[0]->id;
    }
    public static function getNombre($id)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM partido WHERE id="'.$id.'"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Partido($tabla['id'], $tabla['nombre'], $tabla['presidente'], $tabla['vicepresidente']);
        }

        return $list[0]->nombre;
    }
    public static function guardar($nombre, $presidente, $vicepresidente)
    {
        $db = Db::getInstance();
        $sql = $db->prepare("INSERT INTO partido(nombre,presidente,vicepresidente)values(?,?,?)");
        $sql->bindParam(1, $nombre, PDO::PARAM_STR, 50);
        $sql->bindParam(2, $presidente, PDO::PARAM_STR, 50);
        $sql->bindParam(3, $vicepresidente, PDO::PARAM_STR, 50);
        $req = $sql->execute();
        if ($req) {
            return true;
        } else {
            return false;
        }
    }
}
