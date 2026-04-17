<?php
require_once __DIR__ . "/../dao/DaoUser.php";

class ControllerUser {
    private $bundle;
    private $dao;

    public function __construct(array $bundle) {
        $this->bundle = $bundle;
        $this->dao = new DaoUser(); // DAO instancia PDO internamente

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

    private function userAuthentication() {
        $params = $this->bundle['parameters'];

        if (empty($params['email']) || empty($params['pass'])) {
            echo json_encode(["status" => "erro", "mensagem" => "Email ou senha não informados"]);
            return;
        }

        $usuario = $this->dao->getUserByEmail($params['email']);
        $senha_hash = sha1($params['pass']);

        if ($usuario && $senha_hash === $usuario['senha']) {
            echo json_encode([
                "codigo"     => '1',
                "mensagem"   => "Logado com sucesso!",
                "id"         => $usuario['id_usuario'],
                "user_name"  => $usuario['nome'],
                "email"      => $usuario['email'],
                "user_img"   => "https://file.cbsys.digital/media/images/profile/db7fbdb7f82cab930a650e7445608d2b.png",
                "user_token" => "db7fbdb7f82cab930a650e7445608d2b"
            ]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Credenciais inválidas"]);
        }
    }

    private function createUser() {
        $params = $this->bundle['parameters'];

        if (empty($params['nome']) || empty($params['email']) || empty($params['pass'])) {
            echo json_encode(["status" => "erro", "mensagem" => "Dados insuficientes para cadastro"]);
            return;
        }

        if ($this->dao->createUser($params['nome'], $params['email'], $params['pass'])) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Usuário cadastrado!"]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao cadastrar usuário"]);
        }
    }

    private function getUserById() {
        $params = $this->bundle['parameters'];

        if (empty($params['id'])) {
            echo json_encode(["status" => "erro", "mensagem" => "ID do usuário não informado"]);
            return;
        }

        $usuario = $this->dao->getUserById($params['id']);
        if ($usuario) {
            echo json_encode(["status" => "sucesso", "usuario" => $usuario]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado"]);
        }
    }
}
