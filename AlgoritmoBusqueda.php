<?php


class AlgoritmoBusqueda {
    private $grafo;
    private $pila = [];
    public function __construct($grafo) {
        $this->grafo = $grafo;
    }
    
    // este algoritmo trata de encontrar una ruta entre el nodo raiz y el nodo objetivo. si existe la ruta, es decir, si se puede llegar desde el nodo raiz hasta el nodo objetivo. Entonces hay dependencia
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
                // este if es porque cuando se acumulan las distintas llamadas recursivas y la utima devuelve true, es necesario que se devuelva true hacia atras en la pila de llamadas.
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
