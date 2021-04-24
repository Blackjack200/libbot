<?php


namespace libbot;


use libbot\discord\DiscordBot;
use libbot\onebot\OneBot;

final class BotFactory {
	private static array $ls = [];
	private static bool $init = false;

	private function __construct() {
	}

	/**
	 * @param class-string<Bot> $class
	 */
	public static function register(string $name, string $class) : void {
		self::init();
		self::$ls[$name] = $class;
	}

	private static function init() : void {
		if (!self::$init) {
			self::$init = true;
			self::register('discord', DiscordBot::class);
			self::register('onebot', OneBot::class);
		}
	}

	public static function create(string $name, BotInfo $info) : ?Bot {
		self::init();
		/** @var class-string<Bot>|null $clazz */
		$clazz = self::$ls[$name] ?? null;
		if ($clazz === null) {
			return null;
		}
		return new $clazz($info);
	}
}