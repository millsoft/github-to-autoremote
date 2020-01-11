<?php

namespace Millsoft\Notifier\Hooks;

use Millsoft\Notifier\Request;

class SimpleWebHook extends BaseHook{


    public function __construct(){
        parent::__construct();
    }

    public function receive(){
      $this->payload = [
        'blabla' => 'helllooooo'
      ];
      
      echo("RECEIVED by SimpleWebhook!");
    }

    
}

