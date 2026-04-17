<?php
require_once __DIR__ . "/../database/connect.php";

class DaoStatus {
    private $conn;

    public function __construct() {
        global $PDO_CONN;
        $this->conn = $PDO_CONN;
    }

    // Normaliza o telefone para DDI 55 + dígitos
    private function normalizePhone($phone) {
        $phone = preg_replace('/\D/', '', $phone);
        if (substr($phone, 0, 2) !== '55') {
            $phone = '55' . $phone;
        }
        return $phone;
    }

    /**
     * Lista TODOS os status de uma data (YYYY-MM-DD), do mais novo para o mais antigo.
     
     */
    public function getStatusByDate($date, $limit = 1000, $offset = 0) {
        $sql = "SELECT id, status, comentario, data_ultima_atualizacao
                FROM status
                WHERE DATE(data_ultima_atualizacao) = :date
                ORDER BY data_ultima_atualizacao DESC
                LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit',  (int)$limit,  \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Histórico completo de um telefone, do mais novo para o mais antigo.
     
     */
    public function getStatusByPhone($phone, $limit = 100, $offset = 0) {
        $phone = $this->normalizePhone($phone);

        $sql = "SELECT id, status, comentario, data_ultima_atualizacao
                FROM status
                WHERE id = :phone
                ORDER BY data_ultima_atualizacao DESC
                LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':phone',  $phone);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit',  (int)$limit,  \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Insere um novo status (histórico). Usa NOW() no banco.
     * Proteção leve contra duplo clique
     */
    public function setStatus($phone, $status, $comentario) {
        $phone = $this->normalizePhone($phone);

       

        $sql = "INSERT INTO status (id, status, comentario, data_ultima_atualizacao)
                SELECT :phone, :status, :comentario, NOW()
                WHERE NOT EXISTS (
                    SELECT 1 FROM status
                    WHERE id = :phone
                      AND status = :status
                      AND comentario = :comentario
                      AND data_ultima_atualizacao >= NOW() - INTERVAL 5 SECOND
                )";

        $stmt = $this->conn->prepare($sql);
        $ok = $stmt->execute([
            ':phone'      => $phone,
            ':status'     => $status,
            ':comentario' => $comentario
        ]);

         
        return $ok;
    }
}
