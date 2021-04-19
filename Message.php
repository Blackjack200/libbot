<?php


namespace libbot;


interface Message {
	public function toInternal() : string;

	public function content(string $content) : void;
}