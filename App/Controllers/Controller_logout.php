<?php
namespace App\Controllers;

use App\Core\Controller;

class Controller_logout extends Controller
{
    public function action_index()
    {
        session_start();
        $auth = new Controller_auth();
        $auth->delsession();
        if (isset($_COOKIE['token'])) $auth->delcookie();

        $this->view->generate('logout_view.php', 'template_view.php');
    }
}