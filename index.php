<?php

use Millsoft\Notifier\Dispatcher;
use Millsoft\Notifier\Hooks\GithubHook;
use Millsoft\Notifier\Hooks\SimpleWebHook;
use Millsoft\Notifier\Notifier\AutoRemoteNotifier;
use Millsoft\Notifier\Notifier\TestNotifier;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$di = new Dispatcher();

//Simple Test Hook
//To trigger this, open this page like this: http://<host>/index.php?__hook=test
$di->add('test',
	new SimpleWebHook(), [
		new TestNotifier(),
		new AutoRemoteNotifier([
			'apikey' => getenv('AUTOREMOTE_API_KEY'),
		]),
	]
);

//Default hook, will be triggered if called without __hook param:
//This is the actual github webhook
$di->add('default', new GithubHook(), [
	new AutoRemoteNotifier([
		'apikey' => getenv('AUTOREMOTE_API_KEY'),
	]),
]
);

$di->run();
