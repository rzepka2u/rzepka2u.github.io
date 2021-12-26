<?php
require_once "dbconfig.php";
session_start();
if(isset($_POST["identifiant"]))
{
	$succes = '';

	$identifiant = $_POST["identifiant"];
	$motdepasse = $_POST["motdepasse"];	

	$username_error = '';
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

	if(empty($motdepasse))
	{
		$password_error = 'Veuillez donner un mot de passe';	
	}
	else
	{	
		$query = $db->prepare("SELECT motdepasse FROM utilisateur WHERE identifiant=:identifiant");
        $query->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $query->execute();
        $mdp = $query->fetch(PDO::FETCH_ASSOC);
        if($mdp['motdepasse'] !== $motdepasse) {
            $password_error = "Mot de passe incorrect";
        }
	}

	if($username_error == '' && $password_error == '')
	{

        $_SESSION['identifiant'] = $identifiant;		

	    $succes = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
						Connexion effectuée
					</div>';
	}

	$resultat = array('success' => $succes,
					  'username_error' => $username_error,
					  'password_error' => $password_error);

	echo json_encode($resultat);
	
}

?>