<?php

class ExamGenerator {
    protected $string = "A";

    /**
     * Carga las preguntas desde preguntas.yml y
     * devuelve una instancia de Questions con todas
     * las preguntas generadas en el mismo orden que
     * se presentan en el archivo.
     *
     * @param string $yml
     * 
     * @return Questions
     */
    public function loadQuestionsFromYml(string $yml) {
        //$questions = new Questions();
        $this->string .= $yml;
        return $yml;
        //return $questions
    }

    /**
     * Genera un examen en html desde un objeto de
     * tipo Questions.
     *
     * @param Questions $questions
     *
     * @return string
     */
    public function saveQuestionsToHtml(Questions $questions) {
        return $html;
    }
}
