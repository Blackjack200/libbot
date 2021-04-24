<?php


namespace libbot\onebot;


use libbot\Bot;
use libbot\BotInfo;
use libbot\Message;

class OneBot implements Bot {
	private string $url;
	private OneBotThread $thread;

	public function __construct(BotInfo $info) {
		$this->url = $info->url;
		$this->thread = new OneBotThread($this->url);
	}

	public function start() : void {
		$this->thread->start();
	}

	public function shutdown() : void {
		$this->thread->shutdown();
	}

	public function send(Message $message) : void {
		$this->thread->submit($message);
	}
}