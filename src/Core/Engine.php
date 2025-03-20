<?php

namespace Itnaida\Core;

use Itnaida\Core\CommandManager;

class Engine
{
    public static function run($argv)
    {
        $command = $argv[1] ?? 'help';
        $commands = CommandManager::getCommands();

        if (!isset($commands[$command])) {
            echo "O comando {$command} não existe.\n";
            return;
        }

        $param = self::prepereParam($argv);
        
        $commandInstance = new $commands[$command];
        $commandInstance->handle($param);
    }

    public static function prepereParam($param)
    {
        return array_slice($param, 2);
    }    
}
