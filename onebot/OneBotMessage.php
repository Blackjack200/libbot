<?php


namespace libbot\onebot;


use libbot\Message;

class OneBotMessage implements Message {
	private array $data = [];

	public function getData() : array {
		return $this->data;
	}

	public function toInternal() : string {
		return json_encode($this->data, JSON_THROW_ON_ERROR);
	}

	public function content(string $content) : void {
		$this->data['message'] = $content;
	}

	public function group(int $gp) : void {
		$this->data['group_id'] = $gp;
	}

	public function escape(bool $e) : void {
		$this->data['auto_escape'] = $e;
	}
}