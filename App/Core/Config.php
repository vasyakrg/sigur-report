<?php

namespace App\Core;

class Config
{
    public $dbhost = '172.18.0.1'; //hosting;
    public $dbname = 'tc-db-main';
    public $dbuser = 'root';
    public $dbpass = 'secret';

    public $myhash = 'cUP$m9+Ut+@J8@%nYb9t';
    /**
     * @var string Стартовый хост сайта
     */
    public $address_site = "http://report.iqwork.kz/";

    function getmyhash($text)
    {
        return $string = md5($text . $this->myhash);
    }

    function getmyip()
    {
        $myip = file_get_contents('https://api.ipify.org');
        return $myip;
    }
}
