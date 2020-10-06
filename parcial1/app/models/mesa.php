<?php
class mesa
{
    public $id;
    public $codigo;
    public $imagen;
    public $idRecinto;
    public function __construct($id, $codigo, $imagen, $idRecinto)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->imagen = $imagen;
        $this->idRecinto = $idRecinto;
    }
    public static function getMesas()
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM mesa';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new mesa($tabla['id'], $tabla['codigo'], $tabla['imagen'], $tabla['idRecinto']);
        }

        return $list;
    }
    public static function getID($codigoqr)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM mesa WHERE codigo="' . $codigoqr . '"';
        $req = $db->query($sql);
        if (count($req) > 0) {
            //se recoore la lista
            foreach ($req->fetchAll() as $tabla) {
                $list[] = new mesa($tabla['id'], $tabla['codigo'], $tabla['imagen'], $tabla['idRecinto']);
            }
            return $list[0]->id;
        } 
        return false;
    }
}
