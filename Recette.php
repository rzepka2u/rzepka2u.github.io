<?php
//include 'Donnees.inc.php';

class Recette {

    private $Recettes, $Hierarchie;

    public function __construct(array $rec, array $hier) {
        $this->Recettes=$rec;
        $this->Hierarchie=$hier;
    }

    /**
     * @param $recettes array de recettes à afficher
     * @return void
     */
    function afficherLesRecettes(array $recettes) {
        //if (!isset($recettes)) $recettes = $this->Recettes;

        echo " <h2> Recettes : </h2>";
        if (isset($recettes)) {

            foreach ($recettes as $recette) {
                $titre = $recette['titre'];

                echo("<h3>" . $titre . "</h3>");

                $jpg = ucfirst(strtolower(str_replace(" ", "_", $recette['titre'])));

                $jpg = strtr($jpg, array('ñ'=> 'n', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'î' => 'i', 'ï' => 'i', 'ô' => 'o', 'ö' => 'o'));

                if (file_exists("./Photos/$jpg.jpg")) echo "<img src='./Photos/$jpg.jpg' height='80' width='80' alt='$titre' title='$titre'> ";
                else echo "<img src='./images/boisson.png' height='80' width='80' alt='$titre' title='$titre'> ";

                $ing[] = explode('|', $recette['ingredients']);
                echo "<h4> Ingrédients : </h4><ul>";

                foreach ($ing[0] as $i) {
                    echo("<li>" . $i . "</li><br>");
                }
                echo "</ul> <h4>Préparation : </h4>";

                echo($recette['preparation'] . "<br>");

                $index = $recette['index'];

                echo "<h4>Index : </h4><ul>";
                foreach ($index  as $i) {
                    echo("<li>" . $i . "</li><br>");
                }
                echo "</ul>";
            }
        } else echo "Aucune recette disponible";
    }

    /**
     * @param $recettes array[int] de recettes à afficher
     * @return void
     */
    function afficherLesRecettesDepuisNumero(array $numRecettes) {

        $recettes = array();
        foreach ($numRecettes as $numRecette) {
            array_push($recettes, $this->Recettes[$numRecette]);
        }

        echo " <h2> Recettes : </h2>";
        if (isset($recettes)) {

            foreach ($recettes as $recette) {
                $titre = $recette['titre'];

                echo("<h3>" . $titre . "</h3>");

                $jpg = ucfirst(strtolower(str_replace(" ", "_", $recette['titre'])));

                $jpg = strtr($jpg, array('ñ'=> 'n', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'î' => 'i', 'ï' => 'i', 'ô' => 'o', 'ö' => 'o'));

                if (file_exists("./Photos/$jpg.jpg")) echo "<img src='./Photos/$jpg.jpg' height='80' width='80' alt='$titre' title='$titre'> ";
                else echo "<img src='./images/boisson.png' height='80' width='80' alt='$titre' title='$titre'> ";

                $ing[] = explode('|', $recette['ingredients']);
                echo "<h4> Ingrédients : </h4><ul>";

                foreach ($ing[0] as $i) {
                    echo("<li>" . $i . "</li><br>");
                }
                echo "</ul> <h4>Préparation : </h4>";

                echo($recette['preparation'] . "<br>");

                $index = $recette['index'];

                echo "<h4>Index : </h4><ul>";
                foreach ($index  as $i) {
                    echo("<li>" . $i . "</li><br>");
                }
                echo "</ul>";
            }
        } else echo "Aucune recette disponible";
    }

    /**
     * permet d'afficher toute la hierarchie des aliments
     * @return void
     */
    function afficherHierarchie() {
        echo "<h2> Hierarchie : </h2>";

        if (isset($this->Hierarchie)) {

            foreach ($this->Hierarchie as $nom => $contenu) {
                echo "<h3>" . $nom . "</h3> <ul>";

                foreach ($contenu as $type => $i) {
                    echo "<h4>" . $type . "</h4>";

                    foreach ($i as $cat)

                        echo("<li>" . $cat . "</li><br>");

                }

                echo "</ul>";
            }
        }
    }

    /**
     * Affiche les recettes qui contiennent la liste d'ingredients passés en paramètre
     * @param $ingredientDemande array d'ingredients a tester
     * @return void
     */
    function afficherRecette($ingredientDemande) {
        //$ingredientDemande = array();
        //array_push($ingredientDemande, "Cerise");
        //array_push($ingredientDemande, "Rhum","Orange");

        //var_dump($ingredientDemande);

        echo " <h2> Recettes : </h2>";
        if (isset($this->Recettes)) {

            foreach ($this->Recettes as $recette) {

                $ok = true;

                foreach ($ingredientDemande as $item) {
                    if (!in_array($item, $recette['index'])) $ok = false;
                }

                if ($ok) {
                    $titre = $recette['titre'];

                    echo("<h3>" . $titre . "</h3>");

                    $jpg = ucfirst(strtolower(str_replace(" ", "_", $recette['titre'])));

                    $jpg = strtr($jpg, array('ñ'=> 'n', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'î' => 'i', 'ï' => 'i', 'ô' => 'o', 'ö' => 'o'));

                    if (file_exists("./Photos/$jpg.jpg")) echo "<img src='./Photos/$jpg.jpg' height='80' width='80' alt='$titre' title='$titre'> ";
                    else echo "<img src='./images/boisson.png' height='80' width='80' alt='$titre' title='$titre'> ";

                    $ing[] = explode('|', $recette['ingredients']);
                    echo "<h4> Ingrédients : </h4><ul>";

                    foreach ($ing[0] as $i) {
                        echo("<li>" . $i . "</li><br>");
                    }
                    echo "</ul> <h4>Préparation : </h4>";

                    echo($recette['preparation'] . "<br>");

                    $index = $recette['index'];

                    echo "<h4>Index : </h4><ul>";
                    foreach ($index  as $i) {
                        echo("<li>" . $i . "</li><br>");
                    }
                    echo "</ul>";
                }

            }
        }
    }

    /**
     * fonction qui permet de connaitre les sous categories d'une catégorie
     * @param $nom
     * @return array
     */
    function descendreHierarchie($nom) {
        $res = array();
        if (isset($this->Hierarchie)) {

            if (isset($this->Hierarchie[$nom]['sous-categorie'])) {
                //echo "<h3>" . "$nom" . "</h3> <ul>";
                foreach ($this->Hierarchie[$nom]['sous-categorie'] as $type => $i) {
                    //array_push($res, $i);
                    echo "<h4>" . $type . "</h4>";
                    //foreach ($i as $cat)
                    echo("<li>" . $i . "</li><br>");
                }
            }
            //$ing = array();
            //array_push($ing, $nom);
            //$this->afficherRecette($ing);

            //echo "</ul>";

        }
        return $res;
    }

    /**
     * IMPORTANT : fonction qui renvoie les recettes lorsqu'on navigue dans l'interface : affiche TOUTES les recettes qui contiennent un aliment de la categorie passee en parametre
     * @param $cat
     * @return array
     */
    function recetteAvecCategorie($cat) {
        $res = array();

        foreach ($this->Recettes as $recette) {

            foreach ($recette['index'] as $index) {
                if ($index == $cat) {
                    array_push($res, $recette);
                } else {
                    //print_r($this->Hierarchie[$index]['super-categorie']);

                    foreach ($this->Hierarchie[$index]['super-categorie'] as $categorie) {
                        if ($categorie == $cat) {
                            array_push($res, $recette);
                        } else {
                            if (isset($this->Hierarchie[$categorie]['super-categorie']))
                            foreach ($this->Hierarchie[$categorie]['super-categorie'] as $categorie2) {
                                if ($categorie2 == $cat) {
                                    array_push($res, $recette);
                                } else {
                                    if (isset($this->Hierarchie[$categorie2]['super-categorie']))
                                        foreach ($this->Hierarchie[$categorie2]['super-categorie'] as $categorie3) {
                                            if ($categorie3 == $cat) {
                                                array_push($res, $recette);
                                            }
                                        }
                                }
                            }
                        }
                    }
                }
            }

        }
        return $res;
    }


}