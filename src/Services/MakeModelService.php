<?php

namespace Itnaida\Services;

use Exception;
use PDO;

class MakeModelService
{
    private string $className;
    private string $force;
    private string $tableName;

    public function __construct(array $param)
    {
        $this->className = $param['className']; 
        $this->force = isset($param['force']);
        
        $this->tableName = $this->getTableName();
    }
    
    public function handle()
    {
        // Caminho onde o arquivo será criado
        $modelPath = "./app/model/{$this->className}.php";

        $isForce = $this->force;
        if (!$isForce) {
            if (file_exists($modelPath)) {
                throw new Exception("A classe de modelo '{$this->className}' já existe. Use '-f' para sobrescrever.");
            }
        }

        $modelContent = "<?php\n\n";
        $modelContent .= "use Adianti\Database\TRecord;\n\n";
        $modelContent .= "class {$this->className} extends TRecord\n";
        $modelContent .= "{\n";
        $modelContent .= "    const TABLENAME = '$this->tableName';\n";
        $modelContent .= "    const PRIMARYKEY = 'id';\n";
        $modelContent .= "    const IDPOLICY = 'max';\n";
        $modelContent .= "\n";
        $modelContent .= "    public function __construct(\$id = NULL, \$callObjectLoad = TRUE)\n";
        $modelContent .= "    {\n";
        $modelContent .= $this->createAttribute();
        $modelContent .= "        // Constructor logic here\n";
        $modelContent .= "    }\n";
        $modelContent .= "}\n";

        file_put_contents($modelPath, $modelContent);
    }

    private function createAttribute(): string
    {
        $modelContent = "        parent::__construct(\$id, \$callObjectLoad);\n";
        $attrs  = $this->getAttributeTable();

        if ($attrs) {
            foreach ($attrs as $attribute_name) {
                $modelContent .= "        parent::addAttribute('$attribute_name');\n";
            }
        }

        return $modelContent;
    }

    private function getAttributeTable(): array
    {
        TTransaction::open('permission');

        $conn = TTransaction::get();
        $conn = $conn->query("PRAGMA table_info(system_user)");
        $columns_tables = $conn->fetchAll(PDO::FETCH_ASSOC);


        $columns = [];
        foreach ($columns_tables as $column) {
            if ($column['name'] != 'id')
            {
                $columns[] = $column['name'];
            }
        }

        return  $columns;
    }

    private function getTableName()
    {
        // Adiciona um underscore antes de cada letra maiúscula (exceto a primeira)
        $textoSeparado = preg_replace_callback('/([a-z])([A-Z])/', function($matches) {
            return $matches[1] . '_' . strtolower($matches[2]);
        }, $this->className);

        return strtolower($textoSeparado);
    }
}
