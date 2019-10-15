<?php

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Model;
use App\Core\View;

class Controller_profile extends Controller
{
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    public function action_index()
    {
        $auth = new Controller_auth();
        if ($auth->getssesion()) {
            session_start();
            if (isset($_POST["submit"]) && !empty($_POST["submit"]))
            {
                $login = $_SESSION['user'];
                $newpass = $_POST['newpass'];
                $columns = array('password' => $newpass);
                $params = array('login' => $login);

                $this->model->update_data('users', $columns, $params);

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /");
            }
             else {
                 $data = array(
                     'login' => $_SESSION['user'],
                 );
                 $this->view->generate('profile_view.php', 'template_view.php', $data, true);
             }
        }
        else {
            $data = array(
                'login' => 'вы не авторизованы',
            );
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /auth");
//            $this->view->generate('auth_view.php', 'template_view.php', $data, false);
        }
    }
}