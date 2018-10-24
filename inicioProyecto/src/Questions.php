<?php

namespace MultiEval;

class Question {
	protected $description;
	protected $right_options;
	protected $other_options;
	protected $number;
	protected $nopo_visible = TRUE; // None of previous ones
	protected $nopo_message = "Ninguna de las anteriores";
	protected $apo_visible = TRUE; // All previous ones

	public function __construct($description, $right_options, $other_options) {
		$this->description = $description;
		$this->right_options = $right_options;
		$this->other_options = $other_options;
	}

	public function format() {
		$template = "<div class = 'question'>\n";
		$template .= "  <div class = 'number'>" . $this->number . "\n";
		$template .= "  <div class = 'description'>" . $this->description . "\n"; 
	}

	public function print() {

	}
}
