<?php

class Router extends AbstractRouter
{
    /**
     * Display payment form.
     *
     * @param $params
     * @throws Exception
     */
    protected function showForm($params)
    {
        $view  = new View();
        $view->render('form', $params);
    }

    /**
     * Process stripe charge.
     *
     * @param $params
     */
    protected function chargeCustomer($params)
    {
        $processor = new Processor();
        $processor->charge($params);
    }

    /** Display home (landing page).
     * 
     * @throws Exception
     */
    protected function home()
    {
        $view = new View();
        $view->render('home');
    }
}
