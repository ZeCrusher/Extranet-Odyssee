<?php

$go_back = 0;                       		/* affiche résultat ou non 	*/
$chaine_virus='($_COOKIE, $_POST)';			  /* Chaine que je recherche  */
$chaine_virus='057sr';

//$chaine_virus='shell_exec';
//$chaine_virus='error_reporting(0)';
//$chaine_virus='057s';
// $chaine_virus='jquery.min.php'; 

$dir    = '.';
$files = scandir($dir,0);
for ($i=0; $i<count($files); $i++){
	if (fileexiste($files[$i])!="valide")  { 
	// unlink($files[$i]); 
	}
}

$i = 0;														/* compteur de boucle 		*/
$positif=0;
$dir_count = 0;												/* initialisation de la boucle */
$date = time();												/* date et heure actuelle */
$one_day = 86400;											/* nombre de secondes pour une journée */
$days = preg_replace("/[^0-9]/i",'', "99"); 				/* nombre de jours à vérifier */
$path = preg_replace("/[^_A-Za-z0-9-\.%\/]/i",'', "/"); 	/* chemin de fichier absolu (avec nettoyage contre piratage) */
$path = preg_replace("/\.\.\//",'', $path); 				/* on interdit la commande ../ */
define('ABSPATH', dirname(__FILE__));
$path = ABSPATH.$path;  									/* chemin de fichier absolu de votre compte du genre /home/loginftp/www/ ou /home/loginftp/public_html/ etc. */
$directories_to_read[$dir_count] = $path;

echo '<script>';
echo 'console.log(" Anti.Malware Light - ZeCrusher Code - Beta ");';
echo 'console.log("+--------------------------------------------------------------------------+");';
echo 'console.log("I Recherche de chaine de caracteres identifiees - v0.1 php-malware-scanner I");';   
echo 'console.log("+--------------------------------------------------------------------------+");';   

// Restauration des fichiers 
if (!copy("desire/data-indx.php.bak","desire/index.php")) 	echo 'console.log(" Problème pour desire/index.php ");'; else echo 'console.log(" OK pour desire/index.php ");';
if (!copy("data-indx.php.bak","index.php"))                  	echo 'console.log(" Problème pour /index.php - Page D\'accueil");'; else echo 'console.log(" OK pour /index.php - Page D\'accueil");';

/* Affichage du résultat */
$go_back = $one_day * $days;

if ( $go_back > 0 )
{
	$diff = $date - $go_back;
	while ( $i <= $dir_count )
	{
		$current_directory = $directories_to_read[$i];
        	$read_path = opendir( $directories_to_read[$i] );
		while ( $file_name = readdir( $read_path)) {
		/*	Il y a ici un fichier .ico, mais ce n'est pas un favicon.ico */
		
		if ((($file_name[0])==".") && (substr($file_name, -4)==".ico")) 	{ 
			echo 'console.log("Virus .ico ->'.$file_name.'");';
			echo 'console.log(" Dossier -> '.$directories_to_read[$i].'");';
			unlink($directories_to_read[$i].$file_name);
		}
				
	/*	Il y a ici un fichier .ico, mais ce n'est pas un favicon.ico */
	if ((($file_name)=="index.php") && filesize($directories_to_read[$i].$file_name)<500)  { 
		echo 'console.log("taille '.$directories_to_read[$i].$file_name.' ->'.filesize($directories_to_read[$i].$file_name).'");';
		unlink($directories_to_read[$i].$file_name);
	}				
            
	if (( $file_name != '.' )&&( $file_name != '..' ))	{
		if ( is_dir( $current_directory . "/"  . $file_name ) == "dir" )	{
			/* besoin d'obtenir tous les fichiers d'un répertoire */
			$d_file_name =$current_directory.$file_name;
			$dir_count++;
			$directories_to_read[$dir_count] = $d_file_name . "/";
		}
		else
		{
			$file_name = $current_directory . $file_name;                                
			/* Si temps modifiés plus récent que x jours, affiche, sinon, passe */
if ( (filemtime( $file_name)) > $diff  ) {
$date_changed = filemtime( $file_name );
$pretty_date = date("d/m/Y H:i:s", $date_changed);
if ((rechercher_sting_file($file_name,$chaine_virus)== TRUE) && !strpos($file_name,"trex.php") && !strpos($file_name,"tholl.php")) // tholl.php , ce fichier.
{  
echo 'console.log("'.$file_name.'");';
//	if (remplacer_sting_file($file_name, $chaine_virus,"XDXDXDXDXDXDXDXDXDXDXDXD")== TRUE) {
//		unlink($file_name); // Supprimer le fichier ! 
//rename($file_name, $file_name.".neutre");		
$positif++;
echo 'console.log("le fichier est maintenant neutre");';
} 
}
}
}
}
}
closedir ($read_path);
// rename($file_name, $file_name.".neutre");	
$i++;    
}
} 
echo 'console.log("Nombre de fichier dans les dossiers positif : '.$positif.' sur  '.$i.'" );';
echo 'console.log("... fin de la recherche");';
echo '</script>';
	
echo "OK FAIT";


/* ******************************************** */

function remplacer_sting_file($nom_du_fichier,$chaine_source, $chaine_objet) {
$contenu = str_replace($chaine_source, $chaine_objet, file_get_contents($nom_du_fichier));
file_put_contents($nom_du_fichier, $contenu);
return ($contenu);
}    

/* ******************************************* */
function rechercher_sting_file($nom_du_fichier,$chaine_a_rechercher) {
$content = file_get_contents($nom_du_fichier);
$pos = stripos($content, $chaine_a_rechercher);
if ($pos === FALSE) 	{
return(FALSE); /* NON - La chaine n'existe pas dans le fichier */
}
else 	{
//	echo 'console.log("OK DANS -> '.$nom_du_fichier.'");';
return(TRUE); /* OUI - La chaine est bien présente !!! */
}	
}



function fileexiste($nomfile)
{
$nettoyage = Array();
$aeffacer = Array();
$nettoyage[0]=".";
$nettoyage[1]="..";
$nettoyage[2]="odyssee";
$nettoyage[3]="doc";
$nettoyage[4]="";
$nettoyage[5]="log";
$nettoyage[6]="mode";
$nettoyage[7]=".htaccess";
$nettoyage[8]="deconnexion.php";
$nettoyage[9]="favicon.ico";
$nettoyage[10]="index.php";
$nettoyage[11]="signin.php";
$nettoyage[12]="tholl.php";
$nettoyage[13]="trex.php";
$nettoyage[14]="modif.php";	
$nettoyage[14]="data-indx.php.bak";	


for ($j=0; $j<count($nettoyage); $j++) {
if ($nomfile==$nettoyage[$j]) { 
return ("valide"); // valide
} 
}	
return ($nomfile);
}	

?>
