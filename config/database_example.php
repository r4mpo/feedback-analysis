<?php

/**
 * Arquivo de configuração do banco de dados
 *
 * Este arquivo retorna um array associativo contendo as informações
 * necessárias para conectar ao banco de dados.
 *
 * É recomendado não versionar este arquivo com credenciais reais em repositórios públicos.
 */
return [
    // Host do servidor de banco de dados.
    // Use '127.0.0.1' para localhost ou o IP/hostname do servidor remoto.
    'host' => '',
    // Porta do banco de dados.
    // Porta padrão do MySQL é 3306, PostgreSQL 5432.
    'port' => '',
    // Nome do banco de dados que será utilizado.
    'database' => '',
    // Usuário do banco de dados.
    // Este usuário deve ter permissões adequadas para a aplicação.
    'username' => '',
    // Senha do usuário do banco de dados.
    'password' => '',
    // Charset padrão da conexão.
    // utf8mb4 é recomendado para suportar todos os caracteres UTF-8.
    'charset' => 'utf8mb4',
    // Opcional: define se a conexão deve usar persistent connection (PDO)
    'persistent' => false,
    // Opcional: define o tipo de driver de banco de dados
    // Ex: 'mysql', 'pgsql', 'sqlite'
    'driver' => 'mysql',
    // Opcional: habilitar ou desabilitar modo de depuração
    // Útil para exibir erros de conexão em ambiente de desenvolvimento
    'debug' => true,
];