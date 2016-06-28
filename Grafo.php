<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grafo
 *
 * @author Pedro
 */
class Grafo {
    public $nodos=[];

    public function existeNodo($idNodo) {
        $bool = false;
        foreach ($this->nodos as $nodo) {
            if ($nodo->id == $idNodo) {
                $bool = true;
            }
        }
        return $bool;
    }
    
    public function getNodo($id) {
        foreach ($this->nodos as $nodo) {
            if ($nodo->id == $id) {
                return $nodo;
            }
        }
        return null;
    }
    
    public function getHijoNoVisitado($nodo) {
        foreach ($nodo->hijos as $hijo) {
            if (!$hijo->visitado) {
                return $hijo;
            }
        }
        return null;
    }

}
