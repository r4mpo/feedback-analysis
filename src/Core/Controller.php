<?php

namespace Src\Core;

use Src\Utils\RenderView;

class Controller
{
    /**
     * Renderiza uma view específica, passando variáveis para ela.
     *
     * @param string               $view Nome da view (sem extensão .php)
     * @param array<string, mixed> $args Variáveis a serem passadas para a view
     *
     * @return void
     */
    protected function view(string $view, array $args): void
    {
        $renderView = new RenderView();
        $renderView->loadView($view, $args);
    }

    /**
     * Obtém valores enviados via método POST.
     *
     * Esta função verifica se um índice específico foi informado.
     * - Se um índice for passado, retorna o valor correspondente em $_POST ou NULL caso não exista.
     * - Se nenhum índice for passado (ou a string estiver vazia), retorna **todo o array $_POST**.
     *
     * @param string $input Nome do campo esperado no array $_POST.
     *                      Padrão é string vazia, o que retorna todo o array.
     * @return mixed Valor do campo enviado via POST, todo o array $_POST ou NULL se não existir.
     */
    protected function input(string $input = '')
    {
        return !empty($input) ? $_POST[$input] ?? NULL : $_POST;
    }
}