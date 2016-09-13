<?php

class Router extends AbstractRouter
{
    protected function showForm($params)
    {
        $view  = new View();
        $view->render('form', $params);
    }

    protected function chargeCustomer($params)
    {
        $processor = new Processor();
        $processor->charge($params);
    }

    protected function home()
    {
        $view = new View();
        $view->render('home');
    }
}
