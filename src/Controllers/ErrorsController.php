<?php

namespace Src\Controllers;

use Src\Core\Controller;

class ErrorsController extends Controller
{
    /**
     * Exibe a view de erro para rotas não encontradas.
     *
     * @param string $route Caminho requisitado que não foi encontrado.
     *
     * @return void
     */
    public function notFoundRoute($route): void
    {
        $this->view('errors/notFoundRoute', [
            'route' => $route
        ]);
    }

    /**
     * Exibe uma mensagem de erro ou informação na view específica.
     *
     * Esta função carrega a view "errors/showMessage" e envia a mensagem
     * fornecida para ser exibida ao usuário.
     *
     * @param string $message Mensagem que será exibida na tela.
     * @return void
     */
    public function showMessage($message): void
    {
        $this->view('errors/showMessage', [
            'message' => $message
        ]);
    }
}