<?php
namespace App\Core;

class View
{
	function generate($content_view, $template_view, $data = null, $sess = null)
	{
	    include 'App/Views/'.$template_view;
	}
}
