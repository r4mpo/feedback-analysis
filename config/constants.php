<?php

/**
 * Arquivo de definição de constantes globais da aplicação.
 *
 * Este arquivo detecta dinamicamente o protocolo (HTTP/HTTPS), o host e o caminho
 * base do projeto para construir a constante BASE_URL, utilizada como referência
 * para gerar links absolutos e recursos em toda a aplicação.
 *
 * Vantagens:
 * - Funciona em servidores Windows e Linux
 * - Detecta automaticamente HTTP ou HTTPS
 * - Suporta execução em subdiretórios
 * - Compatível com portas personalizadas (ex.: localhost:8000)
 *
 * Constantes definidas:
 * - BASE_URL: URL base completa do projeto (ex.: http://localhost/meu-projeto)
 * - DB_HOST: Servidor do banco de dados (ex.: localhost)
 * - DB_USER: Usuário apto a acessar o banco de dados (ex.: root)
 * - DB_PASS: Credencial para acessar o banco de dados (ex.: )
 * - DB_NAME: Nome do banco de dados selecionado para a aplicação (ex.: fiap_php_db)
 */

// Carrega os dados de configuração do banco
$dbConfig = require_once __DIR__ . '../../config/database.php';

// Detecta protocolo (http ou https)
$scheme = $_SERVER['REQUEST_SCHEME'] ?? (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http'
);

// Host (domínio + porta, se houver)
$host = $_SERVER['HTTP_HOST'];

// Caminho base (remove o nome do script e pega só o diretório)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// Monta a URL base completa
$baseUrl = $scheme . '://' . $host . $basePath;

define('BASE_URL', $baseUrl);
define('DB_HOST', $dbConfig['host']);
define('DB_USER', $dbConfig['username']);
define('DB_PASS', $dbConfig['password']);
define('DB_NAME', $dbConfig['database']);