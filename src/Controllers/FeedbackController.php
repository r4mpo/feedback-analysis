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
        // Recebe o texto enviado via requisição
        $text = $this->input('text');

        // Traduz o texto para o inglês
        $translated_text = $this->translate($text);

        // Tratar o erro de tradução, se necessário
        if (empty($translated_text)) {
            echo json_encode([
                'code' => '111',
                'message' => 'Erro na tradução do texto'
            ]);
            exit;
        }


        // Extrai o texto traduzido corretamente
        $new_text = is_array($translated_text) ? $translated_text[0]['translation_text'] : $translated_text;
var_dump($new_text);exit;
        // Realiza a análise de sentimento no texto traduzido
        $pipe = pipeline('sentiment-analysis');
        $out = $pipe($new_text);
        var_dump($out);
        exit;
    }

    /**
     * Traduz textos para o inglês com IA.
     *
     * @return void
     */
    private function translate($text)
    {
        $translator = pipeline('translation', 'Xenova/m2m100_418M');
        return $translator($text, srcLang: 'aa', tgtLang: 'en');
    }
}