<?php

namespace Src\Controllers;

use Src\Core\Controller;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial do sistema.
     *
     * Essa função chama a view "home" e pode receber dados adicionais
     * para renderização, caso necessário. Atualmente, está enviando
     * um array vazio.
     *
     * @return void
     */
    public function index()
    {
        $this->view('home', []);
    }
}