<?php

class View
{
    const BASE_PATH = 'Views/';

    public function render($file, $params = [])
    {
        $file = self::BASE_PATH . $file .'.php';

        if (!file_exists($file)) {
            throw new Exception('View not found', 500);
        }
        
        $content = file_get_contents($file);
        echo $content;
    }
}
