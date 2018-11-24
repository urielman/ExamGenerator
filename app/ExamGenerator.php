<?php

namespace Generator;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGenerator {

    protected $questions;
    protected $cantidadTemas = 1;
    protected $nroEvaluacion = 1;
    protected $cantidadDePreguntas = -1;

    public function __construct() {
        $this->questions = new Questions();
    }

    public function setCantidadTemas(int $cantidadTemas) { 
        $this->cantidadTemas = $cantidadTemas; 
    }

    public function setNroEvaluacion(int $nroEvaluacion) { 
        $this->nroEvaluacion = $nroEvaluacion; 
    }

    public function setCantidadDePreguntas(int $cantidadDePreguntas) { 
        $this->cantidadDePreguntas = $cantidadDePreguntas; 
    }

    public function getQuestions(){
        return $this->questions;
    }

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
                $filePathExamenes . "/RespuestasTema{$nroTema}" . $fileExtension,
                $this->template($preguntas, $nroTema, $this->nroEvaluacion, 'Respuestas', $this->cantidadDePreguntas)
            );
            file_put_contents(
                $filePathExamenes . "/Tema{$nroTema}" . $fileExtension,
                $this->template($preguntas, $nroTema, $this->nroEvaluacion, 'Examen', $this->cantidadDePreguntas)
            );
        }
        ++$this->nroEvaluacion;
    }

    /**
     * Devuelve si la respuesta esta en la lista de respuestas correctas. 
     * Si no hay respuestas correctas, devuelve "ninguna es correcta".
     * Si no hay respuestas incorrectas, devuelve "todas son correctas".
     *
     * @param array $preguntas
     * @param string $respuesta
     * @return string
     */
    private function esCorrecta($preguntas, $respuesta = ""){
        if(empty($preguntas['respuestas_correctas'])){
            return "ninguna es correcta";
        }

        if(empty($preguntas['respuestas_incorrectas'])){
            return "todas son correctas";
        }

        if(in_array($respuesta, $preguntas['respuestas_correctas'])){
            return "correcta";
        }

        return FALSE;
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
    private function template(array $preguntas, $tema = NULL, int $nroEvaluacion = 0, string $modo = '', $cantidadDePreguntas) : string {
        $esOriginal = !in_array($modo, ['E', 'examen', 'Examen', 'A', 'alumno', 'Alumno']);
        $titulo = ($nroEvaluacion == 0) ? "Examen" : "Examen {$nroEvaluacion}";
        $titulo .= ($esOriginal) ? " - Respuestas" : " - Alumno";
        $titulo .= ($tema == NULL) ? "" : " - Tema {$tema}";

        $ningunaDeLasAnteriores = "Ninguna de las anteriores.";
        $todasLasAnteriores = "Todas las anteriores.";
        $evaluacionHeader = "Evaluación" . (($nroEvaluacion == 0) ? "" : " Número {$nroEvaluacion}");
        $temaHeader = ($tema == NULL) ? "" : "TEMA {$tema}";
        $class = "";
        $questions = "";

        //se escriben la cantidad de preguntas $cantidadDePreguntas hasta que no ya haya mas disponibles.
        for($nroPregunta = 0; ($nroPregunta < $cantidadDePreguntas || $cantidadDePreguntas == -1) && isset($preguntas[$nroPregunta]); $nroPregunta++) {
            
            $nroPreguntaDesde1 = $nroPregunta + 1;
            $answers = "";
            foreach ($preguntas[$nroPregunta]['respuestas'] as $nroRespuesta => $respuesta) {

                if($modo == "Respuestas"){
                    $esCorrecta = $this->esCorrecta($preguntas[$nroPregunta], $respuesta);
                    if($esCorrecta == "correcta"){
                        $class = " respuestaCorrecta";
                    }
                    else{
                        $class = "";
                    }
                }

                $letraRespuesta = chr(ord('a')+$nroRespuesta);
                $answers .= "
                    <div class=\"option{$class}\">{$letraRespuesta}) {$respuesta}</div>";
            }

            if (empty($preguntas[$nroPregunta]['ocultar_opcion_todas_las_anteriores'])){
                if($modo == "Respuestas"){
                    $esCorrecta = $this->esCorrecta($preguntas[$nroPregunta]);
                    if($esCorrecta == "todas son correctas"){
                        $class = " respuestaCorrecta";
                    }
                    else{
                        $class = "";
                    }
                }
                $nroRespuesta++;
                $letraRespuesta = chr(ord('a')+$nroRespuesta);
                $answers .= "
                    <div class=\"option{$class}\">{$letraRespuesta}) {$todasLasAnteriores}</div>";
            }

            if (empty($preguntas[$nroPregunta]['ocultar_opcion_ninguna_de_las_anteriores'])){
                if($modo == "Respuestas"){
                    $esCorrecta = $this->esCorrecta($preguntas[$nroPregunta]);
                    if($esCorrecta == "ninguna es correcta"){
                        $class = " respuestaCorrecta";
                    }
                    else{
                        $class = "";
                    }
                }
                $nroRespuesta++;
                $letraRespuesta = chr(ord('a')+$nroRespuesta);
                $answers .= "
                    <div class=\"option{$class}\">{$letraRespuesta}) {$ningunaDeLasAnteriores}</div>";
            }

            $question = "
                <div class=\"question\">
                    <div class=\"number\">{$nroPreguntaDesde1})______</div>
                    <div class=\"description\">{$preguntas[$nroPregunta]['descripcion']}</div>
                    <div class=\"options short\">{$answers}
                    </div>
                </div>";
            $questions .= $question;
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

            .respuestaCorrecta {
                text-decoration: underline;
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
