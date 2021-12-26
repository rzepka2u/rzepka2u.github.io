<?php // Creation de la base de donnees

  function query($link,$requete)
  { 
    $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
	return($resultat);
  }

  
$mysqli=mysqli_connect('localhost', 'root', '') or die("Erreur de connexion");
$base="Projet_Boissons";
$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
		CREATE TABLE utilisateur (login VARCHAR(20) PRIMARY KEY, motDePasse VARCHAR(30) NOT NULL, nom VARCHAR(30), prenom VARCHAR(30), sexe VARCHAR(2), email VARCHAR(255), dateNaissance DATE, adresse VARCHAR(255), codePostal VARCHAR(15), ville VARCHAR(30), numTel VARCHAR(12));
		INSERT INTO utilisateur VALUES ('admin', 'admin', 'Projet', 'Administrateur', 'x', 'admin@boissons.fr', '2000-01-01', 'FST', '54500', 'VANDOEUVRE-LES-NANCY', '0989796959');
	    INSERT INTO utilisateur VALUES ('admin2', 'admin2', 'Projet', 'Administrateur2', 'x', 'admin2@boissons.fr', '2001-01-01', 'FST', '54500', 'VANDOEUVRE-LES-NANCY', '0989796960');
		";

    /*
		CREATE TABLE departement (id INT AUTO_INCREMENT PRIMARY KEY, region INT NOT NULL, lib VARCHAR(255) NOT NULL);
		
		INSERT INTO region VALUES (1, 'Lorraine');
		INSERT INTO region VALUES (2, 'Alsace');

		INSERT INTO departement VALUES (1, 1, 'Moselle');
		INSERT INTO departement VALUES (2, 1, 'Meurthe-et-Moselle');
		INSERT INTO departement VALUES (3, 1, 'Vosges');
		INSERT INTO departement VALUES (4, 1, 'Meuse');
		
		INSERT INTO departement VALUES (5, 2, 'Bas-Rhin');
		INSERT INTO departement VALUES (6, 2, 'Haut-Rhin')";
**/
foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

mysqli_close($mysqli);
?>