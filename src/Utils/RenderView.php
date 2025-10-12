<?php

namespace Src\Utils;

class RenderView
{
  /**
   * Carrega uma view e injeta variáveis no seu escopo.
   *
   * @param string $view Nome da view (sem extensão .php)
   * @param array<string, mixed> $args Variáveis a serem passadas para a view
   */
  public function loadView($view, $args): void
  {
    extract($args);
    $path = '/../../views/';

    require_once __DIR__ . $path . 'templates/header.php';
    require_once __DIR__ . $path . "$view.php";
    require_once __DIR__ . $path . 'templates/footer.php';
  }
}