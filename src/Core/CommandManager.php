<?php

namespace Itnaida\Core;

class CommandManager 
{
    private static array $commands = [];

    public static function addCommand(string $name, string $class): void
    {
        self::$commands[$name] = $class;
    }

    // public static function addCommand(string $name, string $action): void
    // {
        
    //     // self::$commands[] = [
    //     //     'name' => $name,
    //     //     'action' => $action
    //     // ];
    // }

    public static function getCommands(): array
    {
        return self::$commands;
    }
}