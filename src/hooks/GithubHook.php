<?php

namespace Millsoft\Notifier\Hooks;

use Millsoft\Notifier\Request;

class GithubHook extends BaseHook{

    private $payload = null;

    public function __construct(){
        parent::__construct();
    }

    public function receive(){
        $this->payload = $this->request->getRequestPayload();
        $json = $this->payload;
        $this->dataForNotifier = $json;
    }
}