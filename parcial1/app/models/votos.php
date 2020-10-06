<?php
class Votos
{
    public $id;
    public $idPartido;
    public $idMesa;
    public $cantidad;

    public function __construct($id, $idPartido, $idMesa, $cantidad)
    {
        $this->id = $id;
        $this->idPartido = $idPartido;
        $this->idMesa = $idMesa;
        $this->cantidad = $cantidad;
    }
    public static function guardar($idPartido, $idMesa, $cantidad)
    {
        $db = Db::getInstance();
        $sql = $db->prepare("INSERT INTO votos(idPartido,idMesa,cantidad)values(?,?,?)");
        $sql->bindParam(1, $idPartido, PDO::PARAM_INT, 50);
        $sql->bindParam(2, $idMesa, PDO::PARAM_INT, 50);
        $sql->bindParam(3, $cantidad, PDO::PARAM_INT, 50);
        $req = $sql->execute();
        if ($req) {
            return true;
        } else {
            return false;
        }
    }
    public static function mesayaVotada($idMesa)
    {
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM votos WHERE idMesa="' . $idMesa . '"';
        $req = $db->query($sql);
        if (count($req) > 0) {
            //se recoore la lista
            foreach ($req->fetchAll() as $tabla) {
                $list[] = new Votos($tabla['id'], $tabla['idPartido'], $tabla['idMesa'], $tabla['caantidad']);
            }
            if(count($list)>0){
            return count($list);
            }else{
                return 0;
            }
        }
        return 0;
    }
    public static function devolverDatos($idMesa){
        $list = [];
        $db = Db::getInstance();
        $sql = 'SELECT * FROM votos where idMesa="'.$idMesa.'"';
        $req = $db->query($sql);

        //se recoore la lista
        foreach ($req->fetchAll() as $tabla) {
            $list[] = new Votos($tabla['id'], $tabla['idPartido'], $tabla['idMesa'], $tabla['cantidad']);
        }
        if(count($list)>0){
        return $list;
        }else{
            return 0;
        }
    }
}
