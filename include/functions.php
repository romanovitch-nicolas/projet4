<?php
// Supprime les caractères accentués
function delete_accents($text){
    $accents = array("Ã€","Ã ","Ã‚","Ãƒ","Ã„","Ã…","Ã ","Ã¡","Ã¢","Ã£","Ã¤","Ã¥","Ã’","Ã“","Ã”","Ã•","Ã–","Ã˜","Ã²","Ã³","Ã´","Ãµ","Ã¶","Ã¸","Ãˆ","Ã‰","ÃŠ","Ã‹","Ã¨","Ã©","Ãª","Ã«","Ã‡","Ã§","ÃŒ","Ã ","ÃŽ","Ã ","Ã¬","Ã¬","Ã®","Ã¯","Ã™","Ãš","Ã›","Ãœ","Ã¹","Ãº","Ã»","Ã¼","Ã¿","Ã‘","Ã±","Å“");
    $replace = array("A","A","A","A","A","A","a","a","a","a","a","a","O","O","O","O","O","O","o","o","o","o","o","o","E","E","E","E","e","e","e","e","C","c","I","I","I","I","i","i","i","i","U","U","U","U","u","u","u","u","y","N","n","oe");
    $text = str_replace($accents, $replace, $text);
    return($text);
}


// Transforme un texte en format URL
function transform_into_url($text, $limit=100){
    if(!empty($text)){
        $to_replace = array("ê","è","é","&agrave;","&iuml;","&eacute;","<strong>","</strong>","â‚¬","&",":","_","!","?","'","\""," ","(",")","+",".",",","/","%","â€¦"," ","Â²","'","â€™","Â®","Â©","ï","ç","ô","&Agrave;");
        $replace_by = array("e","e","e","a","i","e","","","euros","et","-","-","","","-","-","-","","","-","-","-","-","pourcent","","-","2","-","","","","i","c","o","A");
        
        $text = htmlspecialchars_decode($text);
        $text = delete_accents($text);
        $text = strtolower($text);
        $text = str_replace($to_replace, $replace_by, $text);

        while(preg_match('/--/',$text)) $text = str_replace('--', '-', $text);

        $text = htmlentities($text);
        $text = str_replace(array("&", ";"), "", $text);
       
        if($limit > 0 && strlen($text) > $limit) $text = substr($text, 0, $limit);

        $length = strlen($text)-1;
        while($text{$length}=='-'){
            $text = substr($text, 0, $length);
            $length--;
        }
    }
    return($text);
}

?>