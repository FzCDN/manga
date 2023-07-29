<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class RouterController extends CoreController
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    private function addRoute($method, $path, $callback) {
        $path = rtrim($path, '/');
        
        $route = new Route($path, ['_controller' => $callback]);
        $route->setMethods([$method]);
        $this->routes[] = $route;
    }

    public function dispatch() {
    
        if (MAINTEN === 'yes' ) {
           if (strpos($_SERVER['REQUEST_URI'], '/' . DASHBOARD_URL) !== 0 && strpos($_SERVER['REQUEST_URI'], '/auth/login') !== 0 && strpos($_SERVER['REQUEST_URI'], '/' . LOGIN_URL) !== 0 && (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true)){
              $this->mainteMode();
              exit;
           }
        }
        
        $cacheKey = md5($_SERVER['REQUEST_URI']);
        
        $cachedContent = $this->getCachedContent($cacheKey);

        if (CACHE !== 'no' && $cachedContent !== false && $_SERVER['REQUEST_METHOD'] === 'GET' && LICENSE_ACTIVATING !== '1') {
            if (strpos($_SERVER['REQUEST_URI'], '/sitemap') === 0) {
                header('Content-type: text/xml');
                header('Cache-Control: public, max-age=1200'); 
                header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 1200) . ' GMT'); 
                header('Pragma: cache'); 

                echo $cachedContent;
            } else {
                header('Cache-Control: public, max-age=3600'); 
                header('Cache-Control: public, max-age=1200'); 
                header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 1200) . ' GMT'); 
                header('Pragma: cache'); 
                echo $cachedContent;
            }
            exit;
        }
        
        if (isset($_POST['licenseKey']) && LICENSE_ACTIVATING !== '1') {
            $this->activateLicense($_POST['licenseKey']);
            exit;
        }
         
        if (LICENSE_ACTIVATING !== '1') {
            $this->viewAuth('activating');
            exit;
        }
        
        $routeCollection = new RouteCollection();

        foreach ($this->routes as $route) {
            $routeCollection->add(md5(serialize($route)), $route);
        }
        
        $request = Request::createFromGlobals();
        $pathInfo = rtrim($request->getPathInfo(), '/'); 
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($routeCollection, $context);

        try {
            $parameters = $matcher->match($pathInfo); 
            $callback = $parameters['_controller'];
            unset($parameters['_controller']);

            $this->executeCallback($callback, $parameters);
        } catch (ResourceNotFoundException $e) {
            $this->render404();
            exit();
        }
    }

    private function executeCallback($callback, $parameters)
    {
        $path = $_SERVER['REQUEST_URI'];

        if (strpos($path, '/dashboard') === 0) {
            if (!$this->isAuthenticated()) {
                $this->redirectToLogin();
            }
        }

        if (is_callable($callback)) {
            $content = $callback($parameters);
        } elseif (is_array($callback)) {
            $controller = new $callback[0]();
            $method = $callback[1];

            $refMethod = new \ReflectionMethod($controller, $method);
            $numParams = $refMethod->getNumberOfParameters();

            if ($numParams > 0) {
                $routeParams = array_values($parameters);
                $content = $controller->$method(...$routeParams);
            } else {
                $content = $controller->$method();
            }
        }
    }

    private function isAuthenticated() {
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
    }

    private function redirectToLogin() {
        header('Location: /' . LOGIN_URL);
        exit;
    }

    private function getCachedRoutes($cacheKey) {
       return isset($_SESSION[$cacheKey]) ? $_SESSION[$cacheKey] : null;
    }

    private function cacheRoutes($cacheKey, $routeCollection) {
       $_SESSION[$cacheKey] = $routeCollection;
    }
    
}
