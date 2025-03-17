<?php

    function getLanguage(){
        $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
        return $idioma;
    }
	$idioma_usuario = getLanguage();

	if (!isset($_SESSION['lang']) || !isset($_SESSION['langflag'])){
		$idioma_usuario = getLanguage();
		if($idioma_usuario == "es"){
			$_SESSION['lang'] = "es";
			$_SESSION['langflag'] = "espana";
		}
		elseif($idioma_usuario == "en"){
			$_SESSION['lang'] = "en";
			$_SESSION['langflag'] = "estados-unidos";
		}
		elseif($idioma_usuario == "it"){
			$_SESSION['lang'] = "it";
			$_SESSION['langflag'] = "italia";
		}
		elseif($idioma_usuario == "pt"){
			$_SESSION['lang'] = "pt";
			$_SESSION['langflag'] = "brazil";
		}
		else{
			$_SESSION['lang'] = "en";
			$_SESSION['langflag'] = "estados-unidos";
		}
		
	}
	else if ( isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang']))
	{
		if ($_GET['lang'] == "es"){
			$_SESSION['lang'] = "es";
			$_SESSION['langflag'] = "espana";
		}
		else if ($_GET['lang']  == "en"){
			$_SESSION['lang'] = "en";
			$_SESSION['langflag'] = "estados-unidos";
		}
		else if ($_GET['lang']  == "it"){
			$_SESSION['lang'] = "it";
			$_SESSION['langflag'] = "italia";
		}
		else if ($_GET['lang']  == "pt"){
			$_SESSION['lang'] = "pt";
			$_SESSION['langflag'] = "brazil";
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	require_once "languages/" . $_SESSION['lang'] . ".php";


	
?>