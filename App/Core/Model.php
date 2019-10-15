<?php
namespace App\Core;

class Model extends \PDO
{
    private static $instance;
    public $db;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

	public function __construct()
    {
        $config = new Config();
        $this->db = new \PDO("mysql:host=$config->dbhost;dbname=$config->dbname", "$config->dbuser", "$config->dbpass");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->exec("SET NAMES 'utf8';");

    }

    // метод выборки данных
	public function get_data($str)
    {
//        $columns=array_values($columns);
//        $values = array();
//        if (isset($orderby)) $orderby = ' ORDER BY '.$orderby.' DESC'; else $orderby = '';
//        if (isset($params) && is_array($params)) {
//            foreach ($params as $key => $val) $values[]=$key."='".$val."'";
////            print_r($values);
//            $str='SELECT ' .implode(', ', $columns) . ' FROM ' . $table  . ' WHERE ' . implode(' AND ', $values) .$orderby. ' LIMIT '. $limit;
////            echo $str;
//        }
//        else
//            $str='SELECT ' .implode(',', $columns) . ' FROM ' . $table  . $orderby. ' LIMIT '. $limit;
////        echo $str;

        $fetch = 'assoc';
        $myresult = $this->db->prepare($str);
        $myresult->execute();

        if (isset($fetch)) {
            switch ($fetch) {
                case 'assoc' :
                    {
                        $myfetch = \PDO::FETCH_ASSOC;
                        $data = $myresult->fetchAll($myfetch);
                        break;
                    }
                case 'num' :
                    {
                        $myfetch = \PDO::FETCH_NUM;
                        $data = $myresult->fetch($myfetch);
                        break;
                    }
            }
        } else {
            $myfetch = \PDO::FETCH_ASSOC;
            $data = $myresult->fetchAll($myfetch);
        }
//        print_r($data);
        return  $data;
	}

	public function insert_data($table, $params)
    {
        $columns=array_keys($params);
        $values=array_values($params);
        $str="INSERT INTO $table (".implode(', ',$columns).") VALUES ('" . implode("', '", $values) . "' )";
//        echo $str;
        if ($myresult = $this->db) $myresult->exec($str);
    }

    public function update_data($table, $columns, $params)
    {
        $vals = array_values($params);
        $keys = array_keys($params);
        for ($i=0;$i<count($params);$i++) $rows[$i] = $keys[$i] . "='" . $vals[$i] ."'";

        $vals2 = array_values($columns);
        $keys2 = array_keys($columns);
        for ($i=0;$i<count($columns);$i++) $rowscol[$i] = $keys2[$i] . "='" . $vals2[$i] ."'";

        $str="UPDATE $table SET " . implode(", ", $rowscol) . " WHERE " . implode(", ", $rows);
//        echo $str;
        if ($myresult = $this->db) $myresult->exec($str);
    }

    public function del_data($table, $params){
        $keys=array_keys($params);
//        print_r($keys);
        $values=array_values($params);
//        print_r($values);
        for ($i=0;$i<count($params);$i++) $rows[$i] = $keys[$i]."='". $values[$i] ."'";

        $str="DELETE FROM $table WHERE " . implode(', ',$rows);
//        echo $str;
        if ($myresult = $this->db) $myresult->exec($str);
    }
}
