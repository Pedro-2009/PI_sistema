<?php
/**
 * INIT — Inicialização global do Sesc Esports
 * -------------------------------------------
 * Este arquivo prepara o ambiente básico para todas as páginas do sistema:
 * - Inicia a sessão (se necessário)
 * - Carrega o config.php e arquivos essenciais do sistema
 * - Garante que funções, banco de dados e constantes estejam disponíveis
 */

// 🧠 Inicia sessão, se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🧩 Carrega o arquivo de configuração principal
require_once(__DIR__ . '/config.php');

// 📦 Inclui arquivos essenciais
require_once(INC_PATH . '/database.php');
require_once(INC_PATH . '/globalFunctions.php');

// 🔒 Função de segurança opcional (exemplo de controle de acesso)
function requireLogin($redirect = '/login.php') {
    if (empty($_SESSION['user'])) {
        header("Location: " . BASE_URL . $redirect);
        exit;
    }
}

// ⚙️ Configura timezone padrão
date_default_timezone_set('America/Sao_Paulo');

// ✅ Ambiente pronto para uso
// A partir daqui, qualquer arquivo que inclua "init.php"
// já terá acesso a: sessão ativa, DB, funções globais e constantes.
