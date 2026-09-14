<?php

class Controller
{
    protected function view($arquivo, $dados = [])
    {
        extract($dados);

        require "../app/Views/" . $arquivo . ".php";
    }
}