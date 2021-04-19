<?php


namespace libbot\discord;


use libbot\ManagedThread;
use libbot\Message;
use Threaded;

class DiscordThread extends ManagedThread {
	private string $url;
	private Threaded $buffer;

	public function __construct(string $url) {
		$this->url = $url;
		$this->buffer = new Threaded();
	}

	public function submit(Message $msg) : void {
		$this->buffer[] = $msg->toInternal();
		$this->notify();
	}

	public function process() : void {
		/** @var string|null $msg */
		$msg = $this->buffer->shift();
		if ($msg !== null) {
			$curl = curl_init($this->url);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $msg);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
			curl_exec($curl);
			curl_close($curl);
		}
	}
}