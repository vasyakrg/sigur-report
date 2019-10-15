<?php
namespace App\Core;
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'main';
		$action_name = 'index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{
			$controller_name = $routes[1];
		}

		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

        $query = $_SERVER['QUERY_STRING'];

        if (!empty($query)) {
            $temp = explode ('&', $query);
            foreach ($temp as $pair) {
                list ($k,$v) = explode ('=',$pair);
                $params_action[$k] = $v;
            }
            $action_name = 'params';
        }

//        print_r($params_action);
		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;


        $controller_name = 'Controller_'.$controller_name;
        $controller_name_path = "App\Controllers\\";
        
		// подцепляем файл с классом модели (файла модели может и не быть)

//		$model_file = strtolower($model_name).'.php';
        $model_file = $model_name . '.php';
		$model_path = "App/Models/".$model_file;
		if(file_exists($model_path))
		{
			include "App/Models/".$model_file;
		}
//		else Route::ErrorPage404('model');

		// проверяем наличие файла с классом контроллера
        $controller_file = $controller_name.'.php';
		$controller_path = "App/Controllers/".$controller_file;
		if(file_exists($controller_path))
		{
		    $fullname = $controller_name_path.$controller_name;
            $controller = new $fullname();
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404('method');
		}

		// создаем экшин
        $action_name = 'action_'.$action_name;
		$action = $action_name;

        if(method_exists($controller, $action))
		{
//			// вызываем действие контроллера
            if ($action_name == 'action_params') $controller->$action($params_action);
             else $controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404('action');
		}

	}

	static function ErrorPage404($text)
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
//      header('HTTP/1.1 404 Not Found');
//		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
