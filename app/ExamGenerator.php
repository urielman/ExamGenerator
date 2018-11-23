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
        /* if (is_dir($filePath . '/originales')) {
            // borrar contenido de la carpeta (por si hay examenes viejos)
        }
        else {
            mkdir($filePath . '/originales', 0777, true);
        } */
        if (is_dir($filePath . '/examenes')) {
            // borrar contenido de la carpeta (por si hay examenes viejos)
        }
        else {
            mkdir($filePath . '/examenes', 0777, true);
        }
        $filePathOriginales = $filePath . '/originales';
        $filePathExamenes = $filePath . '/examenes';
        for ($nroTema = 1; $nroTema <= $this->cantidadTemas ; ++$nroTema) {
            $this->questions->mezclar();
            $preguntas = $this->questions->getPreguntas();
            /* file_put_contents(
                $filePathOriginales . "/Tema{$nroTema}" . $fileExtension,
                $this->template($preguntas, $nroTema, $this->nroEvaluacion)
            ); */
            file_put_contents(
                $filePathExamenes . "/Tema{$nroTema}" . $fileExtension,
                $this->template($preguntas, $nroTema, $this->nroEvaluacion, 'Examen')
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
    private function template(array $preguntas, $tema = NULL, int $nroEvaluacion = 0, string $modo = '') : string {
        $esOriginal = !in_array($modo, ['E', 'examen', 'Examen', 'A', 'alumno', 'Alumno']);
        $titulo = ($nroEvaluacion == 0) ? "Examen" : "Examen {$nroEvaluacion}";
        $titulo .= ($esOriginal) ? " - Original" : " - Alumno";
        $titulo .= ($tema == NULL) ? "" : " - Tema {$tema}";

        $evaluacionHeader = "Evaluación" . (($nroEvaluacion == 0) ? "" : " Número {$nroEvaluacion}");
        $temaHeader = ($tema == NULL) ? "" : "TEMA {$tema}";

        $questions = "";
        if ($esOriginal) {
            // TODO
        }
        else {
            foreach ($preguntas as $nroPregunta => $pregunta) {
                $nroPreguntaDesde1 = $nroPregunta + 1;
                $answers = "";
                foreach ($pregunta['respuestas'] as $nroRespuesta => $respuesta) {

                    $answers .= "
                        <div class=\"option\">{$nroRespuesta}) {$respuesta}</div>";
                }
                $question = "
                <div class=\"question\">
                    <div class=\"number\">{$nroPreguntaDesde1})______</div>
                    <div class=\"description\">{$pregunta['descripcion']}</div>
                    <div class=\"options short\">{$answers}
                    </div>
                </div>";
                $questions .= $question;
            }
        }
        return "<!DOCTYPE html>\n<html>
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
    }
}
