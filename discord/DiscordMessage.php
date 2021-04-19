<?php


namespace libbot\discord;


use libbot\Message;

class DiscordMessage implements Message {
	private array $data = [];

	public function toInternal() : string {
		return json_encode($this->data, JSON_THROW_ON_ERROR);
	}

	public function content(string $content) : void {
		assert(strlen($content) < 2000);
		$this->data['content'] = $content;
	}
}