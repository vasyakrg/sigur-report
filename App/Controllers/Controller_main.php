<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Model_main;

class Controller_main extends Controller
{
    function __construct()
    {
        $this->model = new Model_main();
        $this->view = new View();
    }

    function action_index()
    {
//        session_start();
//        $auth = new Controller_auth();
//        if ($auth->getssesion())
//            $sess = true; else $sess = false;

//            $columns = array(
//          'name' => 'name',
//          'status' => 'status',
//          'detail' => 'detail',
//          'work' => 'work',
//          'lastupdate' => 'lastupdate'
//        );
        $current_month = date('m');
        $current_year = date('Y');
        $lastday = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
        $datein = $current_year . '-' .$current_month . '-01 00:00:00';
        $dateout = $current_year . '-' .$current_month .'-'.$lastday. ' 23:59:59';

        $str = 'SELECT plans.VALUE, users.NAME, users.DATECRE, users.DATEEXP, datediff(users.DATEEXP, users.DATECRE) as qty FROM guestbindings as users, sideparamvalues as plans WHERE plans.OBJ_ID = users.ID and users.DATECRE >= "' . $datein . '" and users.DATEEXP <= "'. $dateout . '" ORDER BY plans.VALUE ASC';
//        echo $str;

        $data = $this->model->get_data($str);
        $this->view->generate('main_view.php', 'template_view.php', $data, false);
    }

}
