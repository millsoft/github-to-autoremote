<?php

namespace Millsoft\Notifier\Hooks;

use Millsoft\Notifier\Request;
use Millsoft\Notifier\Base;

class BaseHook extends Base{

	public $dataForNotifier = null;

    public function  __construct(){
        parent::__construct();
    }

}


