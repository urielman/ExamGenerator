<?php

namespace Generator;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGenerator {

    protected $questions;
    protected $cantidadTemas = 1;
    protected $nroEvaluacion = 1;

    public function __construct() {
        $this->questions = new Questions();
    }

    public function setCantidadTemas(int $cantidadTemas) { $this->cantidadTemas = $cantidadTemas; }

    public function setNroEvaluacion(int $nroEvaluacion) { $this->nroEvaluacion = $nroEvaluacion; }

    /**
     * Carga las preguntas desde un archivo Yaml y
     * devuelve una instancia de Questions con todas
     * las preguntas generadas en el mismo orden que
     * se presentan en el archivo.
     *
     * @param string $ymlFile
     */
    public function loadQuestions(string $ymlFile) {
        try {
            $yml = Yaml::parseFile($ymlFile);
        } catch (ParseException $exception) {
            printf('No se puede convertir el archivo YAML: %s', $exception->getMessage());
        }
        $this->questions->vaciar();
        foreach ($yml['preguntas'] as $pregunta) {
            $this->questions->agregar($pregunta);
        }
    }

    /**
     * Genera un examen en html desde el objeto de
     * tipo Questions guardado en el examen.
     * (Es el metodo print)
     *
     * @param string $htmlFile
     *
     * @return string
     */
    public function saveQuestions(string $filePath, string $fileExtension = '.html') {
        for ($nroTema = 1; $nroTema <= $this->cantidadTemas ; ++$nroTema) {
            $this->questions->mezclar();
            $preguntas = $this->questions->getPreguntas();
            $template = $this->template($preguntas, $nroTema, '', $this->nroEvaluacion);
            file_put_contents(
                $filePath . "Tema{$nroTema}" . $fileExtension,
                $template
            );
        }
        ++$this->nroEvaluacion;
    }

    /**
     * Devuelve un string, formato HTML, que
     * es el examen generado a partir de los
     * parametros dados.
     *
     * @param array $preguntas
     * @param mixed $tema
     * @param string $modo
     * @param int $nroEvaluacion
     *
     * @return string
     */
    private function template(array $preguntas, $tema = NULL, string $modo = '', int $nroEvaluacion = 0) : string {
        $titulo = ($modo == '') ? "" : "{$modo} - ";
        $titulo .= ($nroEvaluacion == 0) ? "Examen" : "Examen {$nroEvaluacion}";
        $titulo .= ($tema == NULL) ? "" : " - Tema {$tema}";

        $evaluacionHeader = "Evaluación" . (($nroEvaluacion == 0) ? "" : " Número {$nroEvaluacion}");
        $temaHeader = ($tema == NULL) ? "" : "TEMA {$tema}";

        $questions = "";
        foreach ($preguntas as $nroPregunta => $pregunta) {
            $answers = "";
            foreach ($pregunta['respuestas'] as $nroRespuesta => $respuesta) {
                $answers .= "
                    <div class=\"option\">{$nroRespuesta}) {$respuesta}</div>";
            }
            $question = "
            <div class=\"question\">
                <div class=\"number\">{$nroPregunta})______</div>
                <div class=\"description\">{$pregunta['descripcion']}</div>
                <div class=\"options short\">{$answers}
                </div>
            </div>";
            $questions .= $question;
        }

        $template = "<!DOCTYPE html>\n<html>
    <head>
        <title>{$titulo}</title>
        <meta charset=\"utf-8\">
        <meta name=\"description\" content=\"\">
        <meta name=viewport content=\"width=device-width, initial-scale=1\">

        <style>

            .question {
                border: 1px solid gray;
                padding: 0.3em;
            }

            .number {
                float: left;
                margin-right: 0.5em;
                font-weight: bold;
            }

            .options {
                display: flex;
                flex-direction: column;
            }

            .short {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 1em;
            }

            .questions {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 1em 1em;
            }

            .header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 1em;
            }

            .description {
                margin-bottom: 0.5em;
                font-weight: bold;
            }

            body {
                font-size: 12px;
            }

        </style>
    </head>
    <body>
        <div class=\"header\">
            <strong>Nombre y Apellido _____________________________________________ </strong>
            <strong>{$evaluacionHeader}</strong>
            <strong>{$temaHeader}</strong>
        </div>
        <div class=\"questions\">{$questions}
        </div>
    </body>\n</html>\n";
        return $template;
    }
}
