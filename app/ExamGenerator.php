<?php

namespace Generator;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGenerator {

    protected $questions;

    public function __construct() {
        $this->questions = new Questions();
    }

    /**
     * Carga las preguntas desde un archivo Yaml y
     * devuelve una instancia de Questions con todas
     * las preguntas generadas en el mismo orden que
     * se presentan en el archivo.
     *
     * @param string $ymlFile
     */
    public function loadQuestionsFromYml(string $ymlFile) {
        try {
            $yml = Yaml::parseFile($ymlFile);
        } catch (ParseException $exception) {
            printf('No se puede convertir el archivo YAML: %s', $exception->getMessage());
        }
        foreach ($yml['preguntas'] as $pregunta) {
            $this->questions->agregar($pregunta);
        }
    }

    /**
     * Genera un examen en html desde el objeto de
     * tipo Questions guardado en el examen.
     *
     * @param string $htmlFile
     *
     * @return string
     */
    public function saveQuestionsToHtml(string $htmlFile) {
        //$html = questionsToHtml($questions);
        //file_put_contents($htmlFile, $html);
        //return $html;
    }
}
