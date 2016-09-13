<?php

class AbstractRouter
{
    protected $method;

    protected $uri;

    public function routeRequest()
    {
        try {
            $this->parseRequest();
            $this->isValidRoute();
            return $this->processRoute();

        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    protected function parseRequest()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url =  parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $url['path'] ;
    }

    protected function processRoute()
    {
        $handler = $this->routes()[$this->uri]['handler'];
        $params = $this->getFormParams();

        if (method_exists($this, $handler)) {
            return $this->$handler($params);
        }
        throw new Exception("No handler defined for Url: {$this->uri}", 500);
    }

    protected function routes()
    {
        return [
            '/' => [
                'method' => 'GET',
                'handler' => 'home'
            ],

            '/form' => [
                'method' => 'GET',
                'handler' => 'showForm'
            ],
            '/charge' => [
                'method' => 'POST',
                'handler' => 'chargeCustomer'
            ],
        ];
    }

    protected function isValidRoute()
    {
        if (isset($this->routes()[$this->uri])) {
            if ($this->routes()[$this->uri]['method'] == $this->method) {
                return true;
            }
            throw new Exception('Method not allowed.', 405);
        }
        throw new Exception('Page not found.', 404);
    }

    protected function getFormParams()
    {
        return array_merge($_POST, $_GET);
    }
}