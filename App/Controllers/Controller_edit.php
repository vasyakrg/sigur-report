<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Model;
use App\Core\View;

class Controller_edit extends Controller
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

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /");
                $this->view->generate('main_view.php', 'template_view.php', null, true);
            }
             else {
                 header("HTTP/1.1 301 Moved Permanently");
                 header("Location: /");
                 $this->view->generate('main_view.php', 'template_view.php', null, false);
             }
    }

    public function action_params($params)
    {
        $auth = new Controller_auth();
        if ($auth->getssesion()) {
            session_start();
            if (isset($_POST["submit"]) && !empty($_POST["submit"])) {
              if (!isset($_POST['delete'])) {
                  $id = $_POST['id'];
                  $name = $_POST['name'];
                  $detail = $_POST['detail'];
                  $work = $_POST['work'];
                  $lastupdate = date("Y-m-d H:i:s");
                  $status = $_POST['status'];

                  $date = array('date' => $lastupdate);

                  $columns = array(
                      'name' => $name,
                      'status' => $status,
                      'detail' => $detail,
                      'work' => $work,
                      'lastupdate' => $lastupdate
                  );

                  $params = array(
                      'id' => $id
                  );
                  $paramslog = array('who' => $_SESSION['user'], 'daterun' => $lastupdate, 'str' => 'name='.$name.'; detail='.$detail.'; status='.$status);
                  $this->model->update_data('list', $columns, $params);
                  $this->model->insert_data('log', $paramslog);
                  header("HTTP/1.1 301 Moved Permanently");
                  header("Location: /");
//                  $this->view->generate('edit_view.php', 'template_view.php', $date, true);
              }
             else
                {
                    $id = $_POST['id'];
                    $params = array('id' => $id);
                    $this->model->del_data('list', $params);

                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: /");
//                    $this->view->generate('main_view.php', 'template_view.php', null, true);
                }
            }
             else {
                 $id = $params['id'];
                 $mycolunms = array(
                     'id' => 'id',
                     'name' => 'name',
                     'status' => 'status',
                     'detail' => 'detail',
                     'work' => 'work',
                     'lastupdate' => 'lastupdate'
                 );
                 $myparams = array('id' => $id);

                 $data = $this->model->get_data('list', $mycolunms, $myparams, 1, 'assoc', null);
                 $this->view->generate('edit_view.php', 'template_view.php', $data, true);
             }
        } else {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /auth");
//            $this->view->generate('auth_view.php', 'template_view.php', null, false);
        }

    }
}