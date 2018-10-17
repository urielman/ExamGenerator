<?php

namespace MultiEval;

class ExamGenerator {

    public function loadQuestions() {
        $questions = new Questions;
        return $questions;
    }
}
