<?php

namespace Src\Controllers;

use Src\Core\Controller;
use function Codewithkyrian\Transformers\Pipelines\pipeline;

class FeedbackController extends Controller
{
    /**
     * Analisa os sentimentos contidos no comentário recebido com IA.
     *
     * @return void
     */
    public function analyze(): void
    {
        $text = $this->input('text');
        $translated_text = $this->translate($text);
        var_dump($translated_text);
        exit;


        $pipe = pipeline('sentiment-analysis');
        $out = $pipe($text);
        var_dump($out);exit;
    }

    /**
     * Traduz textos para o inglês com IA.
     *
     * @return void
     */
    private function translate($text)
    {
        $translator = pipeline('translation', 'Xenova/m2m100_418M');
        return $translator($text, 'en', 256);
    }
}