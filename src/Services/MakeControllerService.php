<?php

namespace Itnaida\Services;

use Exception;
use Itnaida\Utils\PrintLog;

class MakeControllerService
{
    private string $className;

    public function __construct(string $className)
    {
        $this->className = $className; 
        // armazenar no atrr
    }
    
    public function handle()
    {
        // Caminho onde o arquivo será criado
        $controllerPath = "./app/Controllers/{$this->className}.php";

        // Verifica se o arquivo já existe
        if (file_exists($controllerPath)) {
            throw new Exception("A classe de controlador '{$this->className}' já existe.");
        }

        // Conteúdo da classe que será gerada
        // Conteúdo da classe que será gerada
        $controllerContent = "<?php\n\n";
        $controllerContent .= "class {$this->className}Controller\n";
        $controllerContent .= "{\n";
        $controllerContent .= "    public function __construct(\$id = NULL)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        // Constructor logic here\n";
        $controllerContent .= "    }\n";
        $controllerContent .= "    // Adicione as propriedades e métodos aqui\n";
        $controllerContent .= "}\n";

        // Criar o arquivo PHP
        file_put_contents($controllerPath, $controllerContent);

        echo "Controlador '{$this->className}Controller' criado com sucesso em: {$controllerPath}\n";
    }
    

    // public function __construct($id = NULL)
    // {
    //     parent::__construct($id);
    //     parent::addAttribute('name');
    // }

    private function createAttribute(string $name) 
    {
        return "parent::addAttribute('$name');";
    }
}
