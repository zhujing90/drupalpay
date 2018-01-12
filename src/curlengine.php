<?php

namespace Drupalpay;

class Curlengine
{
	public $ch = null;

	private $post = [];

	private $head = [];

	private function initializeCH()
	{
		unset($this->ch);
	}

	private function initializeHead ()
	{
		$this->head = [Config::CONTENT_TYEP, Config::ACCEPT_TYPE];
	}

	private function setAppKey ()
	{
		$this->head[] = Config::APP_KEY;
	}

	public function sendHead ()
	{
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->head);
		return $this;
	}

	private function initializePost ()
	{
		$this->post = [];
		return $this;
	}

	public function setEmail ()
	{
		$this->post['email'] = Config::EMAIL;
		return $this;
	}

	public function setPassword ()
	{
		$this->post['password'] = Config::PASSWORD;
		return $this;
	}

	public function setPost ($key, $value)
	{
		$this->post[$key] = $value;
		return $this;
	}

	public function sendPost()
	{
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->post));
		return $this;
	}

	public function start($route = '', $useAppKey = false)
	{
		$this->initializeCH();

		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, Config::BASE_URL.$route);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($this->ch, CURLOPT_HEADER, FALSE);

		$this->initializeHead();
		if ($useAppKey) {
			$this->setAppKey();
		}
		$this->sendHead();

		return $this;
	}

	public function useGet ($route = '', $useAppKey = false)
	{
		return $this->start($route, $useAppKey);
	}

	public function usePost ($route = '', $useAppKey = false)
	{
		$this->start($route, $useAppKey);
		curl_setopt($this->ch, CURLOPT_POST, TRUE);
		return $this->initializePost();
	}

	public function getResult ()
	{
		$response = curl_exec($this->ch);
		curl_close($this->ch);

		if ($decodedResponse = json_decode($response, true)){
			return $decodedResponse;
		}

		throw new \Exception(10000, 'Invalid fatt API return data:['.$response.']');
	}
}

?>