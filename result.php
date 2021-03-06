<?php

require 'Nodo.php';
require 'Grafo.php';
require 'AlgoritmoBusqueda.php';
$nodos = [];
/* 
recorro la lista de precedencias, si un nodo ya existe no lo agrego a la lista de nodos, 
 * luego agrego a los nodos sucesores como hijos del nodo predecesor.
   */
foreach ($_REQUEST['data'] as $precedencia) {
    $nodo = null;
    $i = searchNodo($precedencia['nodo'],$nodos);
    if ($i == -1) {
        $nodo = new Nodo();
        $nodo->id = $precedencia['nodo'];
        $nodo->visitado = false;
        $nodos[] = $nodo;
    } else {
        $nodo = $nodos[$i];
    }
    $nodoSucesor;
    $i = searchNodo($precedencia['precedeA'], $nodos);
    if ($i == -1) {
        $nodoSucesor = new Nodo();
        $nodoSucesor->id = $precedencia['precedeA'];
        $nodoSucesor->visitado = false;
        $nodos[] = $nodoSucesor;
    } else {
        $nodoSucesor = $nodos[$i];
    }
    $nodo->hijos[] = $nodoSucesor;
    
}
//creo un grafo a partir de los nodos
$grafo = new Grafo();
$grafo->nodos = $nodos;


// e
if ($grafo->existeNodo($_REQUEST['nodoRaiz']) && $grafo->existeNodo($_REQUEST['nodoObjetivo'])) { //valido si existen los nodos introducidos para checkear dependencias
    $result = (new AlgoritmoBusqueda($grafo))->buscarDependecia($_REQUEST['nodoRaiz'], $_REQUEST['nodoObjetivo']);  //Se fija si hay dependencia, entre el id de un nodo raiz y de un nodo objetivo
    echo $result==true?"SI depende":"No depende";
} else {
    echo 'Las ciudades ingresadas no son correctas';
}






// funcion que valida si ya esxiste un nodo, de ser asi devuelve el indice en el array, sino devuelve -1
function searchNodo($id,$nodos) {
    $i = null;
    $indice = 0;
    foreach ($nodos as $n) {
        if ($id == $n->id) {
            $i = $indice;
            return $i;
        }
        $indice++;
    }
    if (is_null($i)) {
        $i=-1;
    }
    return $i;
}