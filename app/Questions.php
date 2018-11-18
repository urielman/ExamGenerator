<?php

namespace Generator;

class Questions {

    protected $preguntas = array();
    protected $cantidad = 0;
    protected $ordenOriginal = array();
    protected $orden = array();

    /**
     * Añade una pregunta con sus respuestas.
     *
     * @param array $pregunta
     */
    public function agregar(array $pregunta) {
        $pregunta['respuestas'] = array_merge(
            $pregunta['respuestas_correctas'],
            $pregunta['respuestas_incorrectas']
        );
        array_push($this->preguntas, $pregunta);

        $ordenRespuestas = array();
        foreach ($pregunta['respuestas'] as $i => $respuestas) {
            array_push($ordenRespuestas, $i + 1);
        }
        /* for ($i = 1; i <= count($pregunta['respuestas']); ++$i) {
            array_push($ordenRespuestas, $i);
        } */
        ++$this->cantidad;
        $this->ordenOriginal[$this->cantidad] = $ordenRespuestas;
        $this->orden[$this->cantidad] = $ordenRespuestas;
    }
    
    /**
     * Mezcla las preguntas y sus respectivas respuestas de forma
     * aleatoria.
     */
    public function mezclar() {
        $ordenNuevo = $this->ordenOriginal;
        foreach ($ordenNuevo as $ordenRespuestasNuevo) {
            shuffle($ordenRespuestasNuevo);
        }
        shuffle($ordenNuevo);
        $this->orden = $ordenNuevo;
    }
}
