<?php
class loginController
{
    public function index()
    {
        $mensajeError = '';
        require_once('../app/views/login/index.php');
    }
    public function getallUsers()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $ss = $_POST['email'];
            $ff = $_POST['password'];
            $datos = login::entrar($ss, $ff);
            $f = json_encode($datos);

            echo $f;
        }
    }
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
           
            $jose = login::entrar($email, $pass);

            $count = count($jose);
            if ($count != 0) {
                if (session_status() == PHP_SESSION_NONE) {
                    ob_start();
                    session_start();
                }
                $_SESSION['datosuser'] = $jose;
                $_SESSION["login"] = 'okay';

                require_once('../app/views/pages/home.php');
            } else {
                $mensajeError = 'intente de nuevo no DB';
                echo 'intente de nuevo no DB';
                require_once('../app/views/login/index.php');
            }
        } else {
            $mensajeError = 'Usuario inhabilitado';
            echo 'ok';
            //require_once('../app/views/login/index.php');
        }
        //  }else{
        //  $mensajeError='ingrese credenciales';
        //  require_once('../app/views/login/index.php');
        //}
    }

    public function cerrar()
    {
        if (session_status() == PHP_SESSION_NONE) {
            ob_start();
            session_start();
        }
        $_SESSION["login"] = 'okno';
        $mensajeError = '';
        date_default_timezone_set('America/La_Paz');
        $hora2 = date("H:i:s");
        $fecha2 = date("Y-m-d");
        require_once('../app/views/login/index.php');
    }
    public function registar()
    {
        require_once('../app/views/register/index.php');
    }
}
