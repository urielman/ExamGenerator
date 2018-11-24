<?php

namespace Generator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGeneratorTest extends TestCase
{
    /**
     * Testea que ExamGenerator guarda el array de preguntas correctamente en el objeto Questions
     */
    public function testLoadQuestions(){
        $examGenerator = new ExamGenerator;
        $questions = new Questions;

        $ymlFile = './resources/yaml/preguntas.yml';
        $yml = Yaml::parseFile($ymlFile);

        foreach ($yml['preguntas'] as $pregunta) {
            $questions->agregar($pregunta);
        }

        $examGenerator->loadQuestions($ymlFile);

        $this->AssertEquals($examGenerator->getQuestions(), $questions);
        $this->AssertEquals(count($questions->getPreguntasOriginales()), 25);
    }

    /**
     * Testea que se creen 2 archivos por cada tema, y se eliminan los anteriores.
     */
    public function testCantidadDeArchivos(){
        $examGenerator = new ExamGenerator;
        $ymlFile = './resources/yaml/preguntas.yml';

        $examGenerator->loadQuestions($ymlFile);
        $examGenerator->setCantidadTemas(2);
        $examGenerator->setCantidadDePreguntas(15);
        $examGenerator->saveQuestions(
            __DIR__.'./testing',
            '.html'
        );
        
        $filecount = 0;
        $files = glob("./tests/Feature/testing/examenes/*");
        if ($files) {
            $filecount = count($files);
        }

        $this->AssertEquals($filecount, 4);


        $examGenerator->setCantidadTemas(1);
        $examGenerator->saveQuestions(
            __DIR__.'./testing',
            '.html'
        );

        $filecount = 0;
        $files = glob("./tests/Feature/testing/examenes/*");
        if ($files) {
            $filecount = count($files);
        }
        $this->AssertEquals($filecount, 2);
    }
}
