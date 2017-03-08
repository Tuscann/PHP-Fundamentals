<?php
namespace Core;


class Application
{
    const FRONTED_FOLDER = 'fronted';
    public function loadTemplate($templateName,$date=null){
        include self::FRONTED_FOLDER
            .'/'
            .$templateName
            .'.php';
    }
}