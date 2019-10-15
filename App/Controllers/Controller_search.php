<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Model;
use App\Core\View;

class Controller_search extends Controller
{
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function action_index()
    {
//        $auth = new Controller_auth();
//        if ($auth->getssesion()) {
//            session_start();
            if (isset($_POST["submit"]) && !empty($_POST["submit"]))
            {
                $datein = $_POST['datein'];
                $dateout = $_POST['dateout'];
                $plan = $_POST['plan'];

                if ($plan == 'Все') {$plan='%';}
//                echo $plan;

                $str = 'SELECT plans.VALUE, users.NAME, users.DATECRE, users.DATEEXP, datediff(users.DATEEXP, users.DATECRE) as qty FROM guestbindings as users, sideparamvalues as plans WHERE plans.OBJ_ID = users.ID and plans.VALUE like "'.$plan.'" and users.DATECRE >= "' . $datein . '" and users.DATEEXP <= "'. $dateout . '" ORDER BY plans.VALUE ASC';

                $data = $this->model->get_data($str);
                $this->view->generate('main_view.php', 'template_view.php', $data, false);

//                $this->view->generate('main_view.php', 'template_view.php', null, true);

//                $this->view->generate('main_view.php', 'template_view.php', null, true);

            }
            else {
                $current_month = date('m');
                $current_year = date('Y');
                $lastday = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
                $datein = $current_year . '-' .$current_month . '-01 00:00:00';
                $dateout = $current_year . '-' .$current_month .'-'.$lastday. ' 23:59:59';

                $data = array(
                    'datein' => $datein,
                    'dateout' => $dateout
                );

                $this->view->generate('search_view.php', 'template_view.php', $data, false);
            }

//        } else {
//            $data = array(
//                'login' => 'вы не авторизованы',
//            );
//            header("HTTP/1.1 301 Moved Permanently");
//            header("Location: /auth");
//            $this->view->generate('auth_view.php', 'template_view.php', $data, false);
//        }
    }
}
