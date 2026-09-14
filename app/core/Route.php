<?php

class Router
{
    public static function getController()
    {
        return $_GET['controller']
            ?? 'produto';
    }

    public static function getAction()
    {
        return $_GET['action']
            ?? 'home';
    }
}