<?php


namespace libbot\discord;


use libbot\Bot;
use libbot\BotInfo;
use libbot\Message;

class DiscordBot implements Bot {
	private string $url;
	private DiscordThread $thread;

	public function __construct(BotInfo $info) {
		$this->url = $info->url;
		$this->thread = new DiscordThread($this->url);
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