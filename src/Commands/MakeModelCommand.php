<?php

namespace Itnaida\Commands;

use Exception;
use Itnaida\Core\Command;
use Itnaida\Services\MakeModelService;
use Itnaida\Utils\PrintLog;

class MakeModelCommand extends Command
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

            
            print_r($param);
            echo PHP_EOL;
            return;
            $data = [];
            $data['className'] = $param[0];

            if (isset($param[1]) && $param[1] === '-f') {
                $data['force'] = true;
            }

            $service = new MakeModelService($data);
            $service->handle();
    
    
            
            
            PrintLog::success('Class de modelo criado com sucesso');
        }
        catch(Exception $e) 
        {
            PrintLog::error($e->getMessage());
        }
    }

    // talvez ter um metodo que valida os dados passados 
}
