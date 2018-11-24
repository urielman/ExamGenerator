<?php

namespace Generator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class ExamGeneratorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLoadQuestions()
    {
        $examGenerator = new ExamGenerator;
        $questions = new Questions;

        $ymlFile = "/../../resources/yaml/preguntas.yml";
        $yml = Yaml::parseFile($ymlFile);

        foreach ($yml['preguntas'] as $pregunta) {
            $questions->agregar($pregunta);
        }

        $examGenerator->loadQuestions($ymlFile);

        $this->AssertEquals($examGenerator->getQuestions(), $questions);
        $this->AssertEquals(count($questions->getPreguntasOriginales()), 25);
    }
}
