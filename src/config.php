<?php

use Itnaida\Commands\MakeController;
use Itnaida\Commands\MakeModelCommand;
use Itnaida\Core\CommandManager;

CommandManager::addCommand('make:controller', MakeController::class);
CommandManager::addCommand('make:model', MakeModelCommand::class);