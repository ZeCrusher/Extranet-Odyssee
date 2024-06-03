<?php
/* 		 
					MMM"""AMV `7MM"""YMM    .g8"""bgd `7MM"""Mq.`7MMF'   `7MF'.M"""bgd `7MMF'  `7MMF'`7MM"""YMM  `7MM"""Mq.  
					M'   AMV    MM    `7  .dP'     `M   MM   `MM. MM       M ,MI    "Y   MM      MM    MM    `7    MM   `MM. 
					'   AMV     MM   d    dM'       `   MM   ,M9  MM       M `MMb.       MM      MM    MM   d      MM   ,M9  
					   AMV      MMmmMM    MM            MMmmdM9   MM       M   `YMMNq.   MMmmmmmmMM    MMmmMM      MMmmdM9   
					  AMV   ,   MM   Y  , MM.           MM  YM.   MM       M .     `MM   MM      MM    MM   Y  ,   MM  YM.   
					 AMV   ,M   MM     ,M `Mb.     ,'   MM   `Mb. YM.     ,M Mb     dM   MM      MM    MM     ,M   MM   `Mb. 
					AMVmmmmMM .JMMmmmmMMM   `"bmmmd'  .JMML. .JMM. `bmmmmd"' P"Ybmmd"  .JMML.  .JMML..JMMmmmmMMM .JMML. .JMM.
									
*/

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
