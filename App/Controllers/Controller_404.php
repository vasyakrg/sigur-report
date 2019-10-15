<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class Controller_404 extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

	function action_index()
	{
        $auth = new Controller_auth();
        if ($auth->getssesion()) {
            session_start();
            $this->view->generate('404_view.php', 'template_view.php', null, true);
        } else {
            $data = array(
                'login' => 'вы не авторизованы',
            );
            $this->view->generate('404_view.php', 'template_view.php', null, false);
        }
	}

}
