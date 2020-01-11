<?php

namespace Millsoft\Notifier;

use Millsoft\Notifier\Request;

class Base{
    public $request = null;

    public function  __construct(){
        $this->request = new Request();
    }

    public function logRequest($extra = []){
        //TODO: log the current request
    }

}


