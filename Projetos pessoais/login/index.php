<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT nome, email, data_criacao, ultimo_login, hierarquia 
        FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50">
    <header class="header">
        <nav class="nav-container">
            <div class="nav-left">
                <button class="sidebar-toggle">
                    <i class="ri-menu-line"></i>
                </button>
                <h1 class="logo-text">Midia</h1>
                <h3 class="sublogo-text">Call Quality Control</h3>
            </div>
            <div class="nav-right">
                <button class="notification-btn">
                    <i class="ri-notification-2-line"></i>
                    <span class="notification-badge"></span>
                </button>
                <div class="nav-right">
    <!-- Estrutura do Dropdown -->
    <div class="profile-dropdown relative">
        <button id="dropdown-profile" class="flex items-center gap-2">
            <img 
                src="https://ui-avatars.com/api/?name=<?= urlencode($usuario['nome']) ?>&background=ffffff&color=3b82f6" 
                alt="User" 
                class="w-8 h-8 rounded-full"
            >
            <span><?= htmlspecialchars($usuario['nome']) ?></span>
        </button>
        
        <!-- Menu Dropdown (inicialmente oculto) -->
        <div id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
            <a href="profile.php" class="block px-4 py-2 hover:bg-gray-100">
                <i class="ri-user-line"></i> Perfil
            </a>
            <a href="logout.php" class="block px-4 py-2 hover:bg-gray-100">
                <i class="ri-logout-box-r-line"></i> Sair
            </a>
        </div>
    </div>
</div>
            </div>
        </nav>
    </header>

    <aside class="sidebar -translate-x-full">
        <div class="sidebar-header">
            <a href="index.php" class="logo">Midia</a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="index.php" class="active"><i class="ri-dashboard-line"></i> Dashboard</a></li>
                <li><a href=""><i class="ri-settings-line"></i> Configurações</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content ">
        <div class="content-container">
            <div class="welcome-section">
                <h2>Bem-vindo, <?= htmlspecialchars($usuario['nome']) ?></h2>
                <p class="welcome-subtext">Aqui está o resumo do dia</p>
            </div>

            <div class="cards-grid">
                <!-- Card 1 -->
                <div class="info-card">
                    <div class="card-content">
                        <div>
                            <p class="card-label">Data de Criação</p>
                            <h3 class="card-value"><?= date('d/m/Y', strtotime($usuario['data_criacao'])) ?></h3>
                        </div>
                        <div class="card-icon">
                            <i class="ri-calendar-line"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="info-card">
                    <div class="card-content">
                        <div>
                            <p class="card-label">Último Login</p>
                            <h3 class="card-value">
                                <?= $usuario['ultimo_login'] ? date('d/m/Y H:i', strtotime($usuario['ultimo_login'])) : 'Nunca' ?>
                            </h3>
                        </div>
                        <div class="card-icon">
                            <i class="ri-login-circle-line"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="info-card">
                    <div class="card-content">
                        <div>
                            <p class="card-label">Nível de Acesso</p>
                            <h3 class="card-value"><?= htmlspecialchars(ucfirst($usuario['hierarquia'])) ?></h3>
                        </div>
                        <div class="card-icon">
                            <i class="ri-shield-user-line"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="info-card">
                    <div class="card-content">
                        <div>
                            <p class="card-label">Status</p>
                            <h3 class="card-value flex items-center">
                                <span class="status-indicator"></span>
                                Ativo
                            </h3>
                        </div>
                        <div class="card-icon">
                            <i class="ri-checkbox-circle-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-info-card">
                <div class="card-header">
                    <h3>Informações do Usuário</h3>
                    <a href="profile.php" class="edit-link">Editar Perfil</a>
                </div>
                <div class="user-details">
                    <div class="detail-column">
                        <div class="detail-item">
                            <label>Nome Completo</label>
                            <p><?= htmlspecialchars($usuario['nome']) ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Email</label>
                            <p><?= htmlspecialchars($usuario['email']) ?></p>
                        </div>
                    </div>
                    <div class="detail-column">
                        <div class="detail-item">
                            <label>Hierarquia</label>
                            <span class="hierarchy-badge">
                                <i class="ri-user-star-line"></i>
                                <?= htmlspecialchars(ucfirst($usuario['hierarquia'])) ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <label>Membro desde</label>
                            <p><?= date('d/m/Y', strtotime($usuario['data_criacao'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="activity-card">
                <h3>Atividade Recente</h3>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="ri-login-box-line"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Login realizado</p>
                            <p class="activity-time">
                                <?= date('d/m/Y H:i', strtotime($usuario['ultimo_login'] ?? 'now')) ?>
                            </p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="ri-account-circle-line"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Conta criada</p>
                            <p class="activity-time">
                                <?= date('d/m/Y H:i', strtotime($usuario['data_criacao'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/painel.js"></script>
</body>
</html>