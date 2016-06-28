<?php


class AlgoritmoBusqueda {
    private $grafo;
    private $pila = [];
    public function __construct($grafo) {
        $this->grafo = $grafo;
    }
    
    public function buscarDependecia($idNodoRaiz, $idNodoObjetivo) {
        $nodoRaiz = $this->grafo->getNodo($idNodoRaiz);
        $nodoRaiz->visitado = true;
        if ($idNodoRaiz == $idNodoObjetivo) {
            return true;
        } else {
            $hijo = $this->grafo->getHijoNoVisitado($nodoRaiz);
            if (!is_null($hijo)) {
                array_push($this->pila, $nodoRaiz);
                $r = $this->buscarDependecia($hijo->id, $idNodoObjetivo);
                if ($r) {
                    return true;
                }
            } else {
                $topOfPila = array_pop($this->pila);
                if (!is_null($topOfPila)) {
                    $r = $this->buscarDependecia($topOfPila->id, $idNodoObjetivo);
                    if ($r) {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }
        
    }
    
}
