<?php


namespace libbot\discord;


use libbot\Message;

class DiscordMessage implements Message {
	private array $data = [];

	public function getData() : array {
		return $this->data;
	}

	public function toInternal() : string {
		return json_encode($this->data, JSON_THROW_ON_ERROR);
	}

	public function content(string $content) : void {
		assert(strlen($content) < 2000);
		$this->data['content'] = $content;
	}


	public function username(string $username) : void {
		$this->data['username'] = $username;
	}

	public function avatar(string $url) : void {
		$this->data['avatar_url'] = $url;
	}

	public function tts(bool $enabled) : void {
		$this->data['tts'] = $enabled;
	}
}