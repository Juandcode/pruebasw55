<?php
class imagen{
    public $id;
    public $title;
    public $imagen;

    public function __construct($id,$title,$imagen)
    {
        $this->id=$id;
        $this->title=$title;
        $this->imagen=$imagen;
    }
    public static function guardar($image,$title){
        $db = Db::getInstance();
        $query="INSERT INTO imagen (title,image) VALUES ('".$title."' ,'".$image."')";
        $db->prepare($query)->execute();
        $id = $db->lastInsertId('id');
        return $id;
    }
}