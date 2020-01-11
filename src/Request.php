<?php

namespace Millsoft\Notifier;


class Request {

	/**
	 * Get the request payload (json)
	 * @return array
	 */
	public function getRequestPayload() {
		//Receive the RAW post data.
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);

		//If json_decode failed, the JSON is invalid.
		if (!is_array($decoded)) {
			throw new \Exception('Received content contained invalid JSON!');
		}

		return $decoded;
	}

	public function sendJsonPayload($url, $jsonPayload = [], $method = 'POST') {

		$client = new \GuzzleHttp\Client();

		$res = $client->request('POST', $url, [
			'json' => $jsonPayload,
		]);

		$response = $res->getBody();

		return $response;
	}
}