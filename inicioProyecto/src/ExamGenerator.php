<?php

namespace MultiEval;

class ExamGenerator {

    protected $fileName = "test.yml";

    public function loadQuestions() {
        unset($this->questions);

            $questions = Yaml::parseFile($this->fileName);
            
            foreach($questions['preguntas'] as $data){
                $q = new Question($data['descripcion'], $data['respuestas_correctas'], $data['respuestas_incorrectas']);

                if (!empty($data['ocultar_opcion_ninguna_de_las_anteriores'])){
                    $q->setNingunaDeLasAnteriores($data['ocultar_opcion_ninguna_de_las_anteriores']);
                }
                if (!empty($data['ocultar_opcion_todas_las_anteriores'])){
                    $q->setTodasLasAnteriores($data['ocultar_opcion_todas_las_anteriores']);
                }
                //return $questions;

            }

    }
    public function print(){
        return "echo 'hello world'";
    }
}
