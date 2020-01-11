<?php

namespace Millsoft\Notifier\Notifier;

interface iNotify
{
	public function __construct();
	public function sendMessage(array $data);
}