<?php
function voz($texto, $lang = "es"){
    $url = "http://vozme.com/text2voice.php";
    $md5 = md5($texto);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "text=".$texto."&lang=".$lang."&md5=".$md5);
 
    $s = curl_exec ($ch);//Ojo, hay un espacio en exec
    curl_close($ch);
 
    $exp_info = '!http(.+)'.$md5.'(.+)mp3!U';
    preg_match_all($exp_info, $s, $original);
 
    if(count($original)>0){
        return $original[0][0];
    } else {
        return $s;
    }
}




?>

<video controls="" autoplay="" name="media"><source src="<?php print_r(voz("Estimado aprendiz, el Servicio Nacional de Aprendizaje"));?> " type="audio/mpeg"></video>