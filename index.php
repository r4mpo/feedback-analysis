<?php

// Inicia a sessão para permitir o uso de variáveis de sessão na aplicação
session_start();

// Importa as classes principais do núcleo e das rotas
use Src\Core\Core;
use Src\Router\Routes;

// Carrega automaticamente todas as dependências instaladas via Composer
require 'vendor/autoload.php';

// Carrega o arquivo de constantes que será utilizado no projeto
require 'config/constants.php';

// Cria a instância principal do núcleo da aplicação
$core = new Core();

// Executa a aplicação carregando todas as rotas definidas
$core->run(Routes::all());