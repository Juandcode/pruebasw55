<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 5/16/2019
 * Time: 2:29 PM
 */
class PagesController
{
    public function home()
    {
        //echo "asd";
        require_once('../app/views/pages/home.php');
    }

    public function error404()
    {
        require_once('../app/views/template/error404.php');
    }

    public function faq(){
        require_once('../app/views/pages/faq.php');
    }

    public function error500()
    {
        require_once('../app/views/template/error500.php');
    }
}

