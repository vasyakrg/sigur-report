<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Controller;
use App\Core\Model;
use App\Core\View;

class Controller_auth extends Controller
{
    public $auth;

    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->config = new Config();
    }

    public function action_index()
    {
        session_start();
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $rmb = $_POST['rmb'];
        if (isset($_POST["submit"]) && !empty($_POST["submit"]))
            if ($this->checkuser($login, $pass)) {
            if ($rmb == 'on') {
                $this->setcookie($login);

            } else {
                $this->delcookie();
                $this->delsession();
            }
            $this->setsession($login);

            //log write
            $paramslog = array('who'=> $login, 'daterun' => date('Y-m-d H:i:s'), 'str' => 'log on in suite');
            $this->model->insert_data('log', $paramslog);

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /");
            $this->view->generate('mail_view.php', 'template_view.php', null, true);
        }
        else {
            $data = array('login' => 'неправильный логин или пароль!');
            $this->view->generate('auth_view.php', 'template_view.php', $data, false);
        }
        $this->view->generate('auth_view.php', 'template_view.php');
    }

    public function action_params($params)
    {

    }

    public function getidfromlogin($login){
        $params = array(
            'login' => $login,
        );
        $iduser = $this->model->get_data('users', ['0' => 'iduser'], $params, '1', 'num', null);
        return $iduser[0];
    }

    public function getloginfromid($iduser){
        $params = array(
            'iduser' => $iduser,
        );
        $login = $this->model->get_data('users', ['0' => 'login'], $params, '1', 'num', null);
        return $login[0];
    }

    public function checkuser($login, $pass)
    {
        $params = array(
            'login' => $login,
            'password' => $pass,
        );
        $result = $this->model->get_data('users', ['0' => 'login'], $params, '1', 'num', null);
        if ($result[0] == $login) return true; else false;
    }

    public function logintoken($login, $token){
        $iduser = $this->getidfromlogin($login);
        $params = array(
            'iduser' => $iduser,
            'token' => $token,
        );
        $result = $this->model->get_data('tokens', ['0' => 'token'], $params, '1', 'num', null);
        if ($result[0] == $token) return $result[0]; else false;
    }

    public function logintokenref($tokenref, $login){
        $params = array(
            'login' => $login,
            'tokenref' => $tokenref,
        );
        $result = $this->model->get_data('tokens', ['0' => 'tokenref'], $params, '1', 'num', null);
        if ($result[0] == $tokenref) return $result[0]; else false;
    }

    public function getidfromtoken($token){
        $params = array(
            'token' => $token,
        );
        $iduser = $this->model->get_data('tokens', ['0' => 'iduser'], $params, '1', 'num', null);
        return $iduser[0];
    }

    public function getidfromtokenref($tokenref){
        $params = array(
            'tokenref' => $tokenref,
        );
        $iduser = $this->model->get_data('tokens', ['0' => 'iduser'], $params, '1', 'num', null);
        return $iduser[0];
    }

    public function refreshtoken($tokenref){
        if (isset($tokenref)) {
            session_start();
//            $iduser = $this->getidfromtokenref($tokenref);
            $login = $this->getloginfromid($iduser);
            $token =    md5($login . time() . $this->config->getmyhash($_SERVER['HTTP_USER_AGENT']));
            setcookie("token", $token, time() + (24 * 60 * 60));
            $columns = array(
                'token' => $token,
                'lastdate' => date('Y-m-d H:i:s'),
                'lastip' => $this->config->getmyip(),
            );
            echo 'token ref';
            $this->model->update_data('tokens', $columns, ['tokenref' => $tokenref]);
            return $token;
        }
    }

    public function getssesion(){
        session_start();
        if (isset($_SESSION['user']))
        {
            if (isset($_COOKIE['tokenref']))
                if (!isset($_COOKIE['token'])) {
                    $this->refreshtoken($_COOKIE['tokenref']);
                    echo '!';
                }
            return true;
        }
             else
             {
                 if (!isset($_SESSION['user']) && $_COOKIE['token'])
                     if ($this->logintoken($this->getidfromtoken($_COOKIE['token']), $_COOKIE['token'])) {
                         $this->setsession($this->getidfromtoken($_COOKIE['token']));
                         return true;
                     }
                    else return false;
             }
    }

    public function setsession($login)
    {
        $_SESSION['user'] = $login;
    }

    public function delsession(){
        unset($_SESSION['user']);
        unset($_SESSION['token']);
    }

    public function getcookie($token, $login)
    {
        session_start();
        if (isset($token) && isset($_COOKIE['tokenref'])) {
            if (!empty($this->logintoken($login, $token)))
                $_SESSION['token'] = $_COOKIE["token"];
            return true;
        } else
        {
//            $_SESSION['token'] = $this->refreshtoken($_COOKIE['tokenref']);
            return false;
        }
    }

    public function setcookie($login){

        $token =    md5($login . time() . $this->config->getmyhash($_SERVER['HTTP_USER_AGENT']));
        $tokenref = md5($login . $this->config->getmyhash($_SERVER['HTTP_USER_AGENT']) . $this->config->getmyhash($this->config->myhash) . rand(1,1000));
        $iduser = $this->getidfromlogin($login);
//        print_r($iduser);

        setcookie("token", $token, time() + (24 * 60 * 60));
        setcookie("tokenref", $tokenref, time() + (7 * 24 * 60 * 60));
        $_SESSION['token'] = $token;
        $params = array(
            'iduser' => $iduser,
            'token' => $token,
            'tokenref' => $tokenref,
            'lastdate' => date('Y-m-d H:i:s'),
            'lastip' => $this->config->getmyip(),
        );
        $this->model->insert_data('tokens', $params);
    }

    public function delcookie(){
        $params = array('tokenref' => $_COOKIE['tokenref']);
        $this->model->del_data('tokens', $params);
        setcookie("token", "", time() - 3600);
        setcookie("tokenref", "", time() - 3600);
    }
}