<?php
require_once "dbconfig.php";

if(isset($_POST["identifiant"]))
{
	$succes = '';

	$identifiant = $_POST["identifiant"];
	$motdepasse = $_POST["motdepasse"];
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$sexe = $_POST["sexe"];
	$email = $_POST["email"];
	$dateNaissance = $_POST["dateNaissance"];
	$adresse = $_POST["adresse"];
	$codepostal = $_POST["postal"];
	$ville = $_POST["ville"];
	$telephone = $_POST["phone"];
	
    $array = array($nom, $prenom, $sexe, $dateNaissance, $adresse, $codepostal, $ville, $telephone);
	foreach($array as $element) {
		if(empty($element)) $element = null;
	}
	

	$username_error = '';
	$email_error = '';
	$password_error = '';

	if(empty($identifiant))
	{
		$username_error = 'Identifiant est requis';
	}
	else
	{
		if(!preg_match("/^[a-zA-Z-' ]*$/", $identifiant))
		{
			$username_error = 'Only Letters and White Space Allowed';
		}
	}

	if(empty($email))
	{
		$email_error = 'L\'adresse email est requise';
	}
	else
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$email_error = 'Entrez une adresse email valide';
		}
	}

	$query = $db->prepare("SELECT * FROM utilisateur WHERE email=:email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
		$email_error = 'Adresse mail déjà utilisée';
    }

	if(empty($motdepasse))
	{
		$password_error = 'Veuillez donner un mot de passe';	
	}
	else
	{	
		if(strlen($motdepasse) < 6)
		{
			$password_error = 'Le mot de passe doit faire au moins 6 caractères';	
		}	
	}

	if($username_error == '' && $email_error == '' && $password_error == '')
	{
			
		$query=$db->prepare("INSERT INTO utilisateur(identifiant,
															motdepasse,
															nom,
															prenom,
															sexe,
															email, 
															dateNaissance,
															adresse,
															codePostal,
															ville,
															numtel)
														VALUES
															(:identifiant,
															:motDePasse,
															:nom,
															:prenom,
															:sexe,
															:email,
															:dateNaissance,
															:adresse,
															:codePostal,
															:ville,
															:numTel)");
													
		$query->bindParam(':identifiant',$identifiant);
		$query->bindParam(':motDePasse', $motdepasse);
		$query->bindParam(':nom', $nom);
		$query->bindParam(':prenom', $prenom);
		$query->bindParam(':sexe', $sexe);
		$query->bindParam(':email', $email);
		$query->bindParam(':dateNaissance', $dateNaissance);
		$query->bindParam(':adresse', $adresse);
		$query->bindParam(':codePostal', $codepostal);
		$query->bindParam(':ville', $ville);
		$query->bindParam(':numTel', $telephone);
					
		$query->execute(); 		

		$succes = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
							Inscription effectuée
						</div>';
	}

	$resultat = array('success' => $succes,
					  'username_error' => $username_error,
					  'email_error'	=> $email_error,
					  'password_error' => $password_error);

	echo json_encode($resultat);
	
}

?>