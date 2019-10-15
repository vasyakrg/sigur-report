<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Model;

class Controller_log extends Controller
{
    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function action_index()
    {
        session_start();
        $auth = new Controller_auth();
        if ($auth->getssesion()) {

            $columns = array(
                'idlog' => 'idlog',
                'who' => 'who',
                'daterun' => 'daterun',
                'str' => 'str'
            );

            $data = $this->model->get_data('log', $columns, null, 100, 'assoc', 'daterun');
            $this->view->generate('log_view.php', 'template_view.php', $data, true);
        }
        else {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /auth");
        }
    }

}