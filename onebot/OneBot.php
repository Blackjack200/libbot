<?php


namespace libbot\onebot;


use libbot\Bot;
use libbot\BotInfo;
use libbot\Message;

class OneBot implements Bot {
	private string $url;
	private int $group;
	private OneBotThread $thread;
	private OneBotMessage $cache;

	public function __construct(BotInfo $info) {
		$this->url = $info->url;
		$this->group = $info->group;
		$this->thread = new OneBotThread($this->url);

		$this->cache = new OneBotMessage();
		$this->cache->escape(false);
		$this->cache->group($this->group);
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

	public function newMessage() : Message {
		return clone $this->cache;
	}
}