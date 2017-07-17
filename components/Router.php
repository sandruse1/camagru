<?php
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
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segment = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segment)) . 'Controller';

                $actionName = 'action' . ucfirst(array_shift($segment));

                $parameters = $segment;
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                //Створюєм обєкт і визиваєм метод
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null){
                    break;
                }
            }
        }
    }
}