<?php


namespace libbot;


use pocketmine\Thread;

class ManagedThread extends Thread {
	private bool $running = false;

	public function start(int $options = PTHREADS_INHERIT_ALL) : void {
		$this->running = true;
		parent::start($options);
	}

	public function run() : void {
		while ($this->running) {
			$this->process();
		}
		$this->synchronized(function () : void {
			$this->wait();
		});
		$this->process();
	}

	public function process() : void {

	}

	public function shutdown() : void {
		$this->synchronized(function () : void {
			$this->running = false;
		});
	}
}