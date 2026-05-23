<?php
session_start();
require 'conexao.php';

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = sha1($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Atualiza ultimo_login
        $updateLogin = "UPDATE usuarios SET ultimo_login = NOW() WHERE id_usuario = ?";
        $stmtUpdate = $conn->prepare($updateLogin);
        $stmtUpdate->bind_param("i", $usuario['id_usuario']);
        $stmtUpdate->execute();

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        header("Location: index.php");
        exit();
    } else {
        $erro = "E-mail e/ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-600 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-6">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-blue-600 mr-2 animate-[pulse_2.2s_cubic-bezier(0.1,0.2,0.5,1)_infinite] origin-center"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                </svg>
                <h1 class="text-3xl font-bold text-gray-800">Midia</h1>
            </div>
            <p class="text-blue-500 uppercase tracking-wider text-sm font-medium">
                Call Quality Control
            </p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded text-center">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
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

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Entrar
            </button>
            <p class="text-sm text-gray-500 text-center mt-2">Não tem conta?
                <a href="signup.php" class="text-blue-500">Cadastre-se</a>
            </p>
        </form>
    </div>
</body>

</html>