<?php

namespace Generator;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGenerator {

    /**
     * Carga las preguntas desde un archivo Yaml y
     * devuelve una instancia de Questions con todas
     * las preguntas generadas en el mismo orden que
     * se presentan en el archivo.
     *
     * @param string $ymlFile
     * 
     * @return Questions
     */
    public function loadQuestionsFromYml(string $ymlFile) : Questions {
        try {
            $yml = Yaml::parseFile($ymlFile);
        } catch (ParseException $exception) {
            printf('No se puede convertir el archivo YAML: %s', $exception->getMessage());
        }
        $questions = new Questions();
        //$questions = ymlToQuestions($yml);
        return $questions;
    }

    /**
     * Genera un examen en html desde un objeto de
     * tipo Questions.
     *
     * @param Questions $questions
     * @param string $htmlFile
     *
     * @return string
     */
    public function saveQuestionsToHtml(Questions $questions, string $htmlFile) {
        //$html = questionsToHtml($questions);
        file_put_contents($htmlFile, $html);
        return $html;
    }
}
