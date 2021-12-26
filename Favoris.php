<?php
include 'Donnees.inc.php';

class Favoris {

    private $numRecettes;

    public function __construct() {
        $this->numRecettes = array();
    }

    public function ajouterRecette($numRecette) {
        if (!array_search($numRecette, $this->numRecettes)) {
            array_push($this->numRecettes, $numRecette);
            $this->fromArrayToCookie();
            return true;
        }
        return false;
    }

    public function supprimerRecette($numRecette) {
        $index = array_search($numRecette,$this->numRecettes);
        unset($this->numRecettes[$index]);
        $this->fromArrayToCookie();
        return true;
    }

    /**
     * getter de la liste de recettes preferees
     * @return array
     */
    public function getNumRecettes() {
        return $this->numRecettes;
    }

    private function fromArrayToCookie() {
        $str = implode(";", $this->numRecettes);
        setcookie("numRecettesFavorites", $str, 0);
    }

    private function fromCookieToArray() {
        $arr = explode(";", $_COOKIE["numRecettesFavorites"]);
        return $arr;
    }

    public function viderFavoris() {
        $this->numRecettes = array();
        $this->fromArrayToCookie();
    }

}