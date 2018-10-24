<?php

require './vendor/autoload.php';

$exam = new ExamGenerator;
$exam->loadQuestions()->print();
