<?php

namespace Src\Core;

use Src\Controllers\ErrorsController;

class Core
{
    /**
     * Executa o roteamento da aplicação com base na URL atual e no conjunto de rotas.
     *
     * Percorre todas as rotas registradas, identifica a correspondente para a URL
     * requisitada e executa o controlador e método associados. Caso nenhuma rota seja
     * encontrada, chama o controlador de erros.
     *
     * @param array<string, string> $routes Lista de rotas no formato:
     *                                      'caminho' => 'Controlador@método'
     *
     * @return void
     */
    public function run(array $routes): void
    {
        $routerFound = false;

        $url = '/';
        $url .= isset($_GET['url']) ? $_GET['url'] : '';
        $url = ($url != '/') ? rtrim($url, '/') : $url;

        foreach ($routes as $path => $method) {
            $pattern = '#^' . preg_replace('/{params}/', '([\w-]+|\d+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                $routerFound = true;

                array_shift($matches);
                [$controller, $action] = explode('@', $method);

                $controller = 'Src\\Controllers\\' . $controller;
                $newController = new $controller();
                $newController->$action($matches);
            }
        }

        if (!$routerFound) {
            $newController = new ErrorsController();
            $newController->notFoundRoute($url);
        }
    }
}
