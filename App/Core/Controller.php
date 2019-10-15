<?php

namespace App\Core;

class Controller {
	
	public $model;
	public $view;
	public $demo;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
	}

	function action_params($params)
    {
    }
}
