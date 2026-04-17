<?php
class Facade {
    private $bundle;

    public function __construct(array $bundle) {
        $this->bundle = $bundle;

        $this->dispatch();
    }

    private function dispatch() {
        if (!isset($this->bundle['controller']['instanceBackend'])) {
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Controller não informado"
            ]);
            return;
        }

        $controllerName = "Controller" . ucfirst($this->bundle['controller']['instanceBackend']); 
        $controllerFile = __DIR__ . "/controller/{$controllerName}.php";

        if (!file_exists($controllerFile)) {
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Arquivo $controllerFile não encontrado"
            ]);
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Classe $controllerName não encontrada"
            ], );
            return;
        }

        
      
        new $controllerName($this->bundle);
    }
}
