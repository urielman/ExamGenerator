<?php

namespace MultiEval;

class Question {
	protected $descripcion;

	protected $respuestas_correctas;

	protected $other_options;

	protected $number;

	protected $ningunaDeLasAnterioresVisible = TRUE; // None of previous ones

	protected $ningunaDeLasAnterioresMensaje = "Ninguna de las anteriores";

	protected $todasLasAnterioresVisible = TRUE; // All previous ones

	protected $todasLasAnterioresMensaje = "Todas las anteriores";


	public function __construct($descripcion, $respuestas_correctas, $other_options) {
		$this->descripcion = $descripcion;
		$this->respuestas_correctas = $respuestas_correctas;
		$this->other_options = $other_options;
	}

	public function format() {
		$template = "<div class = 'question'>\n";
		$template .= "  <div class = 'number'>" . $this->number . "\n";
		$template .= "  <div class = 'descripcion'>" . $this->descripcion . "\n"; 
	}

	public function print() {

	}

	public function setNingunaDeLasAnteriores($visible){
		$this->ningunaDeLasAnterioresVisible = $visible;
	}

	public function getNingunaDeLasAnteriores(){
		return $this->ningunaDeLasAnterioresVisible;
	}
	
	public function setTodasLasAnteriores($visible){
		$this->todasLasAnterioresVisible = $visible;
	}

	public function getTodasLasAnteriores(){
		return $this->todasLasAnterioresVisible;
	}
}
