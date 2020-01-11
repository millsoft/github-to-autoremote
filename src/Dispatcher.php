<?php

namespace Millsoft\Notifier;

/**
 * Entrypoint for all hooks / notifiers
 */
class Dispatcher
{
	private $hooks = [];

	public function __construct(){

	}

	/**
	 * Add a hook / notifier
	 * @param $key a unique name
	 * @param $hook one of the hooks provided in src/hooks
	 * @param $notifiers one or more notifiers in src/notifiers
	 */
	public function add($key, $hook, array $notifiers){

		$this->hooks[$key] = [
			'hook' => $hook,
			'notifiers' => $notifiers,
		];
	}


	public function run(){
		$requestedHook = $_REQUEST['__hook'] ?? null;

		if($requestedHook === null){
			$requestedHook = 'default';
		}
		
		if(!isset($this->hooks[$requestedHook])){
			die("Hook {$requestedHook} not found");
		}

		//execute all notifiers:
		$hook = $this->hooks[$requestedHook];

		//Receive data and parse for notifier:
		$hook['hook']->receive();
		
		foreach($hook['notifiers'] as $notifier){
			//Notify!
			$notifier->sendMessage($hook['hook']);
		}


	}
}