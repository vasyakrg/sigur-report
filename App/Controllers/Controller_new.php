<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Model;
use App\Core\View;

class Controller_new extends Controller
{
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function action_index()
    {
        $auth = new Controller_auth();
        if ($auth->getssesion()) {
            session_start();
            if (isset($_POST["submit"]) && !empty($_POST["submit"]))
            {
                $name = $_POST['name'];
                $detail = $_POST['detail'];
                $params = array(
                    'name' => $name,
                    'detail' => $detail,
                    'status' => 1,
                    'work' => 'в работе',
                    'lastupdate' => date('Y-m-d H:i:s')
                );
                $this->model->insert_data('list', $params);

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /");

//                $this->view->generate('main_view.php', 'template_view.php', null, true);
            }
            else $this->view->generate('new_view.php', 'template_view.php', null, false);
        } else {
            $data = array(
                'login' => 'вы не авторизованы',
            );
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /auth");
//            $this->view->generate('auth_view.php', 'template_view.php', $data, false);
        }
    }
}
