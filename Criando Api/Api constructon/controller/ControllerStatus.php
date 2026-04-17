<?php
require_once __DIR__ . "/../dao/DaoStatus.php";

class ControllerStatus {
    private $bundle;
    private $dao;

    public function __construct(array $bundle) {
        $this->bundle = $bundle;
        $this->dao = new DaoStatus();

        if (!isset($this->bundle['parameters']['feature'])) {
            echo json_encode(["status" => "erro", "mensagem" => "Feature não informada"]);
            return;
        }

        $feature = $this->bundle['parameters']['feature'];
        if (method_exists($this, $feature)) {
            $this->$feature();
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Feature '$feature' inválida"]);
        }
    }

    // Pega todos os status de uma data específica
    private function getStatusDate() {
        $date = $this->bundle['parameters']['date'] ?? date('Y-m-d');
        $result = $this->dao->getStatusByDate($date);
        echo json_encode(["status" => "sucesso", "data" => $result]);
    }

    // Pega status de um telefone específico
    private function getStatusPhone() {
        $phone = $this->bundle['parameters']['phone'] ?? null;
        if (!$phone) {
            echo json_encode(["status" => "erro", "mensagem" => "Telefone não informado"]);
            return;
        }
        $result = $this->dao->getStatusByPhone($phone);
        echo json_encode(["status" => "sucesso", "data" => $result]);
    }

    // Cria ou atualiza status de um telefone
    private function setStatusPhoneDate() {
        $phones = $this->bundle['parameters']['phones'] ?? null;
        $status = $this->bundle['parameters']['status'] ?? '';
        $comentario = $this->bundle['parameters']['comentario'] ?? '';

        if (!$phones) {
            echo json_encode(["status" => "erro", "mensagem" => "Telefone não informado"]);
            return;
        }

        // Permite enviar um array de telefones
        if (!is_array($phones)) {
            $phones = [$phones];
        }

        $allSuccess = true;
        foreach ($phones as $phone) {
            $success = $this->dao->setStatus($phone, $status, $comentario);
            if (!$success) {
                $allSuccess = false;
            }
        }

        if ($allSuccess) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Status salvo com sucesso"]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao salvar status"]);
        }
    }
}


