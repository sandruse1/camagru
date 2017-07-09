<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 13:11
 */

class Router
{
    private $routes;

    //Підключаєм масив шляхів і заносим його в змінну routes

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    // Повертає строку запроса

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        //Получаєм строку запроса

        $uri = $this->getURI();

        //провіряєм наявність запросу в routes.php

        foreach ($this->routes as $uriPattern => $path){

            //Порівнюєм строку запроса і наявні шляхи в routes.php

            if (preg_match("~$uriPattern~", $uri)){

                //оприділяєм контролер для запроса

                $segments = explode('/', $path);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                //оприділяєм екшин для запроса

                $actionName = 'action'.ucfirst(array_shift($segments));

                //Підключаєм файл класса-контролера

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                //Створюєм обєкт і визиваєм метод

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }
            }
        }
    }
}