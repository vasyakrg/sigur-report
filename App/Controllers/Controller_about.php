<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class Controller_about extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function action_index()
    {
        $auth = new Controller_auth();
        if ($auth->getssesion()) {
            session_start();
            $this->view->generate('about_view.php', 'template_view.php', null, true);
        } else $this->view->generate('about_view.php', 'template_view.php', null, false);

    }
}
