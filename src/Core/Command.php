<?php

namespace Itnaida\Core;

abstract class Command
{
    const RESET = "\033[0m";
    const GREEN = "\033[32m";
    const RED = "\033[31m";
    const YELLOW = "\033[33m";
    const BLUE = "\033[34m";
    const CYAN = "\033[36m";

    abstract public function handle(array $param): void;
}
