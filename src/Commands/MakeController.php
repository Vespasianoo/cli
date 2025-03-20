<?php

namespace Itnaida\Commands;

use Exception;
use Itnaida\Core\Command;
use Itnaida\Services\MakeControllerService;
use Itnaida\Utils\PrintLog;

class MakeController extends Command
{
    public function handle(array $param): void
    {
        try
        {
            if (empty($param))
            {
                PrintLog::error('Paramentos empty');
                return;
            }
    
            // validar dados
    
            $data = [];
            $className = $param[0];
            $service = new MakeControllerService($className);
            $service->handle();
    
    
            print_r($param);
            echo PHP_EOL;
            
            PrintLog::success('controler criado com sucesso');
        }
        catch(Exception $e) 
        {
            PrintLog::error($e->getMessage());
        }
    }

    // talvez ter um metodo que valida os dados passados 
}
