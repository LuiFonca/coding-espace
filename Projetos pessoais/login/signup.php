<?php
require 'conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Validação da confirmação de senha
    if ($senha !== $confirmar_senha) {
        $mensagem = "As senhas não coincidem!";
    } else {
        // Verifica se o email já existe
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $mensagem = "E-mail já cadastrado!";
        } else {
            // Criptografa a senha (substitua sha1 por password_hash para mais segurança)
            $senha_hash = sha1($senha);
            
            $sql = "INSERT INTO usuarios (nome, email, senha, status, hierarquia) VALUES (?, ?, ?, 1, 'comum')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $mensagem = "Erro ao criar conta!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-600 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-6">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Cadastro</h1>
            <p class="text-sm text-gray-500">Já tem conta? 
                <a href="login.php" class="text-blue-500">Login</a>
            </p>
        </div>

        <?php if (!empty($mensagem)): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded text-center">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="nome" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="senha" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                <input type="password" name="confirmar_senha" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Criar Conta
            </button>
        </form>
    </div>
</body>
</html>