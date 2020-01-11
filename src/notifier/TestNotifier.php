<?php

namespace Millsoft\Notifier\Notifier;

class TestNotifier extends BaseNotifier implements iNotify
{
	public function __construct(){
		parent::__construct();
	}
	
	public function sendMessage($hook)
	{
		print_r($hook->dataForNotifier);
	}
}