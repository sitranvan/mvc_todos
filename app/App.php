<?php
class App
{
    private $controller;
    private $action;
    private $params;
    private $routes;
    public static $app;
    public function __construct()
    {

        self::$app = $this;
        $this->routes = new Route();
        $this->controller = _DEFAULT_CONTROLLER;
        $this->action = _DEFAULT_ACTION;
        $this->params = [];
        $this->handleUrl();
    }
    final public static function getApp()
    {
        return self::$app;
    }

    // Xử lí url
    public function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        } else {
            return '/';
        }
    }

    public function handleUrl()
    {

        $url = $this->getUrl();
        $url = $this->routes->handleRoute($url);

        $this->handleRouteMiddleware($this->getUriRoute());
        $this->handleProvider();
        $this->handleCheckCompletedTodos();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        // Xử lí trường hợp nếu bên trong controller có thư mục và mới đến controller
        $controllerPath = 'app/controllers';
        $urlCheck = '';
        foreach ($urlArr as $key => $item) {
            $urlCheck .= $item . '/';
            $fileCheck = rtrim($urlCheck, '/');
            $fileArr = explode('/', $fileCheck);
            $fileArr[$key] = ucfirst($fileArr[$key]);
            $fileCheck = implode('/', $fileArr);
            if (!empty($urlArr[$key - 1])) {
                unset($urlArr[$key - 1]);
            }
            if (file_exists($controllerPath . '/' . $fileCheck . '.php')) {
                $urlCheck = $fileCheck;
                break;
            }
        }
        $urlArr = array_values($urlArr);
        // Xử lí khi $urlCheck rỗng
        if (empty($urlCheck)) {
            // Lấy controller mặc định nếu path là /
            $urlCheck =  'todos/' . $this->controller;
        }
        // Xử lí controller
        $this->controller = ucfirst(!empty($urlArr[0]) ? $urlArr[0] : $this->controller);
        $controllerFile = $controllerPath . '/' . $urlCheck . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller();
                unset($urlArr[0]);
            } else {
                $this->renderError();
                return;
            }
        } else {
            $this->renderError();
            return;
        }
        // Xử lí action
        $this->action = !empty($urlArr[1]) ? $urlArr[1] : $this->action;
        unset($urlArr[1]);

        // Xử lí params
        $this->params = array_values($urlArr);

        // Kiểm tra method tồn tại
        if (method_exists($this->controller, $this->action)) {
            call_user_func_array([$this->controller, $this->action], $this->params);
        } else {
            $this->renderError();
        }
    }
    public function getUriRoute()
    {
        return $this->routes->getUri();
    }
    public function handleRouteMiddleware($routeKey)
    {
        global $publicRoutes, $privateRoutes;

        if (in_array($routeKey, $publicRoutes)) {
            $this->handleRoutes('isNotAuthenticated');
        } elseif (in_array($routeKey, $privateRoutes)) {
            $this->handleRoutes('isAuthenticated');
        }
    }
    public function handleRoutes($methodName)
    {
        global $authMiddleware;
        $file  =  'app/middlewares/' . $authMiddleware . '.php';
        if (file_exists($file)) {
            $authMiddlewareObj = new $authMiddleware();
            if (method_exists($authMiddlewareObj, $methodName)) {
                $authMiddlewareObj->$methodName();
            }
        }
    }

    public function handleProvider()
    {
        global $providerMiddleware;
        $file  =  'app/middlewares/' . $providerMiddleware . '.php';
        if (file_exists($file)) {
            if (class_exists($providerMiddleware)) {
                $provider = new $providerMiddleware();
                $provider->providerData();
            }
        }
    }

    public function handleCheckCompletedTodos()
    {
        global $checkMiddleware;
        $file  =  'app/middlewares/' . $checkMiddleware . '.php';
        if (file_exists($file)) {
            if (class_exists($checkMiddleware)) {
                $provider = new $checkMiddleware();
                $provider->checkCompleted();
            }
        }
    }


    public function renderError($errorName = '404', $data = [])
    {
        extract($data);
        $fileError =  _DIR_ROOT . '/app/views/errors/' . $errorName . '.php';
        require_once $fileError;
    }
}
