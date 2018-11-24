<?php

namespace Generator;

class Questions {

    protected $preguntasOriginales = array();
    protected $preguntas = array();
    protected $cantidad = 0;

    public function getPreguntasOriginales(){
        return $this->preguntasOriginales;
    }

    public function vaciar() {
        $this->preguntasOriginales = array();
        $this->preguntas = array();
        $this->cantidad = 0;
    }

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
        $pregunta['ocultar_opcion_ninguna_de_las_anteriores'] = !empty($pregunta['ocultar_opcion_ninguna_de_las_anteriores']);
        $pregunta['ocultar_opcion_todas_las_anteriores'] = !empty($pregunta['ocultar_opcion_todas_las_anteriores']);
        array_push($this->preguntasOriginales, $pregunta);

        ++$this->cantidad;
    }
    
    /**
     * Mezcla las preguntas y sus respectivas respuestas de forma
     * aleatoria.
     */
    public function mezclar() {
        $preguntasNuevas = $this->preguntasOriginales;
        foreach ($preguntasNuevas as &$pregunta) {
            shuffle($pregunta['respuestas']);
        }
        unset($pregunta);   //elimino la referencia.

        shuffle($preguntasNuevas);
        $this->preguntas = $preguntasNuevas;
    }

    /**
     * Devuelve el array de las preguntas, por default
     * mezcladas. Toma como argumento opcional un booleano
     * que determina si se usa el orden original.
     *
     * @param bool $usarPreguntasOriginales
     *
     * @return array
     */
    public function getPreguntas(bool $usarPreguntasOriginales = false) : array {
        $preguntasUsadas = ($usarPreguntasOriginales) ? $this->preguntasOriginales : $this->preguntas;
        
        return $preguntasUsadas;
    }
}
