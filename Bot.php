<?php


namespace libbot;


interface Bot {
	public function __construct(BotInfo $info);

	public function start() : void;

	public function shutdown() : void;

	public function send(Message $message) : void;
}