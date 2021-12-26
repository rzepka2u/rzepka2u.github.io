<?php
include 'Donnees.inc.php';
include 'Recette.php';
include 'Favoris.php';

if (!empty($Recettes) && !empty($Hierarchie)) {
    //var_dump($Recettes);
    $recette=new Recette($Recettes, $Hierarchie);
} else {
    echo "vide";
}


//$recette->descendreHierarchie("Fruit");
//$recette->recetteAvecCategorie("Fruit");
//$recette->creerTableauRecetteCategorie("Fruit");
//$ing = array();
//array_push($ing, "Fruit");
//$recette->afficherRecette($ing);

//$recetteCate = $recette->recetteAvecCategorie("Cerise");
//$recette->afficherLesRecettes($recetteCate);

//print_r($Recettes);
$rec = array();
array_push($rec, 2, 3, 4, 5);
$recette->afficherLesRecettesDepuisNumero($rec);

$fav = new Favoris();

foreach ($rec as $item) {
    $fav->ajouterRecette($item);
}

$fav->supprimerRecette(5);

echo "recettes en cookie : ";
print_r($fav->getNumRecettes());

//$fav->viderFavoris();

//$recette->afficherLesRecettes($Recettes);
//afficherLesRecettes();
//descendreHierarchie("Cerise");