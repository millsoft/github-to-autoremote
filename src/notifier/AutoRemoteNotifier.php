<?php

namespace Millsoft\Notifier\Notifier;

use Problematik\AutoRemote\AutoRemote;
use Problematik\AutoRemote\AutoRemoteMessage;

class AutoRemoteNotifier extends BaseNotifier implements iNotify {

	public function sendMessage($data) {

		$className = (new \ReflectionClass($data))->getShortName();

		if ($className == 'GithubHook') {
			//data comes from github hook
			$this->sendFromGithub($data);
		} elseif($className == 'SimpleWebHook') {
			$message = $data->payload['blabla'];
			$this->_send('SimpleWebHook', $message);
		} else {
			//something else...
			die("else");
		}
	}

	public function _send($title, $text) {
		$text = $this->prepareVoice($text);

		$message = new AutoRemoteMessage();
		$message->message($text);

		$autoremote = new AutoRemote($this->config['apikey']);
		$autoremote->send($message);
	}

	public function sendFromGithub($data) {
		$json = $data->dataForNotifier;

		$commits = $json['commits'];
		$name    = 'Unknown';

		foreach ($commits as $commit) {
			//If you want, you can use the array here to collect some commit messages

			$what = [];
			foreach ($commit['added'] as $file) {
				$what[] = 'NEW: ' . $file;
			}

			foreach ($commit['modified'] as $file) {
				$what[] = 'MOD: ' . $file;
			}

			foreach ($commit['removed'] as $file) {
				$what[] = 'DEL: ' . $file;
			}

			$description = implode("\n", $what);

			$message = 'No Message';

			if(isset($commit['message'])){
				$t       = explode("\n", $commit['message']);
				$message = $t[0];
			}


			$name = $commit['author']['name'];
			$ex   = explode(" ", $name);
			$name = $ex[0];
		}

		$repo = $json['repository'];

		$pre   = '';
		$after = '';

		$content = "$name just pushed to {$repo['name']}! {$message}";

		$this->_send("Github", $content);
	}

	/**
	 * Change strings before send to autoremote
	 * I use this because my TTS engine has problems with some abbreviations
	 * @param  string $str message
	 * @return string
	 */
	private function prepareVoice($str) {

		//Example: if the text contains "erm" it should only say "E" "R" "M" and not "Erm"
		$re     = '/\b(erm)\b/m';
		$subst = 'E R M';
		$str = preg_replace($re, $subst, $str);

		return $str;
	}
}