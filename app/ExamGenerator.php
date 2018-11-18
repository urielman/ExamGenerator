<?php

namespace Generator;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGenerator {

    protected $questions;
    protected $cantidadTemas = 2;
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
        $templateBasePreTitulo = "<!DOCTYPE html>\n<html>
    <head>
        <title>";
        $templateBasePosTitulo = "</title>
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
            <strong>Evaluación número {$this->nroEvaluacion}</strong>
            <strong>TEMA ";
        for ($nroTema = 1; $nroTema <= $this->cantidadTemas ; ++$nroTema) {
            $titulo = "Examen {$this->nroEvaluacion} - Tema {$nroTema}";
            $tituloProfesor = "P - {$titulo}";
            $tituloAlumno = "A - {$titulo}";

            $templateTema = "{$nroTema}</strong>\n        </div>\n        <div class=\"questions\">";

            $this->questions->mezclar();
            $preguntas = $this->questions->getPreguntas();
            foreach ($preguntas as $nroPregunta => $pregunta) {
                $templateTema .= "\n            <div class='question'>";
                $templateTema .= "\n                <div class='number'>{$nroPregunta})______</div>";
                $templateTema .= "\n                <div class='description'>{$pregunta['descripcion']}</div>";
                $templateTema .= "\n                <div class='options short'>";
                foreach ($pregunta['respuestas'] as $nroRespuesta => $respuesta) {
                    $templateTema .= "\n                    <div class='option'>{$nroRespuesta}) {$respuesta}</div>";
                }
                $templateTema .= "\n                </div>\n            </div>";
            }
            $cierreTemplate = "\n        </div>\n    </body>\n</html>\n";
            file_put_contents(
                $filePath . "Tema{$nroTema}" . $fileExtension,
                $templateBasePreTitulo . $titulo . $templateBasePosTitulo . $templateTema . $cierreTemplate
            );
        }
    }
}
