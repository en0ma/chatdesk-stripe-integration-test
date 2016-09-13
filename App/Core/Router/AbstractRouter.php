<?php

class AbstractRouter
{
    /**
     * Request method.
     *
     * @var
     */
    protected $method;

    /**
     * Request url path.
     *
     * @var
     */
    protected $uri;

    /**
     * Process request.
     *
     * @return string
     */
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

    /**
     * Determine method and uri of request.
     *
     */
    protected function parseRequest()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url =  parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $url['path'] ;
    }

    /**
     * Call the handler methods for uri.
     *
     * @return mixed
     * @throws Exception
     */
    protected function processRoute()
    {
        $handler = $this->routes()[$this->uri]['handler'];
        $params = $this->getFormParams();

        if (method_exists($this, $handler)) {
            return $this->$handler($params);
        }
        throw new Exception("No handler defined for Url: {$this->uri}", 500);
    }

    /**
     * Registered routes.
     *
     * @return array
     */
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

    /**
     * Check if its a valid route.
     *
     * @return bool
     * @throws Exception
     */
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

    /**
     * Get form and query string params.
     * 
     * @return array
     */
    protected function getFormParams()
    {
        return array_merge($_POST, $_GET);
    }
}