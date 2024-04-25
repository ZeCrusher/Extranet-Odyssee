<?php


	tracage($_SERVER['PHP_SELF']);

  //include ('tholl.php'); // Anti malware et transformation en fichier .neutre ! 

	header('Location: /odyssee/index.php');

	exit();
  
function tracage($texte) {
    // Si on peut déterminer l'adresse IP
    $adresse_ip = Null;
    if(isset($_SERVER['REMOTE_ADDR'])) {
        $adresse_ip = '"'.$_SERVER['REMOTE_ADDR'].'"';
    }
    $txt_log=$adresse_ip.';'.date('d/m/Y H:i:s').';'.$texte."\n";
    // écriture dans un fichier de traçage
    // $fichier = "log/tracage_".date('Ymd').".log";
    $fichier = "/log/tracage.log";
    preg_match("`^(.*\/)([^\/]+)$`",$_SERVER['SCRIPT_FILENAME'], $matches);
    $chemin_script = $matches[1];
    $fichierCible = $chemin_script.$fichier;
    $myFile=fopen($fichierCible,'a+');
    fputs($myFile,$txt_log);
    fclose($myFile);
}

?>
