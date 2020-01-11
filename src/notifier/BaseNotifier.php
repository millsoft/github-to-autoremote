<?php

namespace Millsoft\Notifier\Notifier;

use Millsoft\Notifier\Base;

class BaseNotifier extends Base{

	//Each notifier can has own configurations, eg api keys, urls, etc..
	public $config = null;

	//Hook will set this after data was parsed
	public $dataForNotifier = null;

    public function  __construct($config = null){
    	$this->config = $config;
        parent::__construct();
    }

}
