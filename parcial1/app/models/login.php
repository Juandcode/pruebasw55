<?php
class login
{
    public $id;
    public $nombre;
    public $correo;
    public $clave;

    public function __construct($id, $nombre, $correo, $clave)
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
    }
    public static function verificarEmail($correo)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM login WHERE correo="' . $correo . '"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new login($tabla['id'], $tabla['nombre'], $tabla['correo'], $tabla['clave']);
        }

        return $list;
    }
    public static function getusers()
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM login';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new login($tabla['id'], $tabla['nombre'], $tabla['correo'], $tabla['clave']);
        }

        return $list;
    }
    public static function getusers2()
    {
        $list = [];

        $db = Db::getInstance();
        $sql = 'SELECT * FROM login';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new login($tabla['id'], $tabla['nombre'], $tabla['correo'], $tabla['clave']);
        }

        return $list;
    }
    public static function entrar($correo, $clave)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM login WHERE correo="' . $correo . '" and clave="' . $clave . '"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new login($tabla['id'], $tabla['nombre'], $tabla['correo'], $tabla['clave']);
        }

        return $list;
    }
    public static function guardar($nombre, $correo, $clave)
    {
        $db = Db::getInstance();
        $sql = $db->prepare("INSERT INTO login(nombre,correo,clave)values(?,?,?)");
        $sql->bindParam(1, $nombre, PDO::PARAM_STR, 50);
        $sql->bindParam(2, $correo, PDO::PARAM_STR, 50);
        $sql->bindParam(3, $clave, PDO::PARAM_STR, 50);
        $req = $sql->execute();
        if ($req) {
            return true;
        } else {
            return false;
        }
    }
}
