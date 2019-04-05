<?php

namespace ClearLagg;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;

class ClearLaggCommand extends Command implements PluginIdentifiableCommand {

	/** @var Loader */
	private $plugin;

	public function __construct(Loader $plugin) {
		parent::__construct("clearlagg", "§8<OP> エンティティ削除", "/clearlagg <check/clear/killmobs/clearall>", ["lagg"]);
		$this->setPermission("clearlagg.command.clearlagg");
		$this->plugin = $plugin;
	}

	/**
	 * @return Plugin|Loader
	 */
	public function getPlugin(): Plugin {
		return $this->plugin;
	}

	public function execute(CommandSender $sender, string $alias, array $args): bool {
		if(!$this->testPermission($sender)) {
			return false;
		}
		if(isset($args[0])) {
			switch($args[0]) {
				case "clear":
					$sender->sendMessage("§a【運営】 §fエンティティを削除しました " . $this->getPlugin()->removeEntities() . " entities");
					return true;

				case "check":
				case "count":
					$c = $this->getPlugin()->getEntityCount();
					$sender->sendMessage("§a【運営】 §f{$c[0]}players, {$c[1]}mobs, {$c[2]}entities のエンティティがあります");
					return true;

				default:
					return false;
			}
		}
		return false;
	}

}
