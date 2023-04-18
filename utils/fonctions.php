<?php

    /**
     * Fonction qui nettoie une chaine de caractères
     */
    function cleanInput($input){
        return htmlspecialchars(strip_tags(trim($input)));
    }


    /**
     * Fonction qui transforme en majuscule la première lettre d'une chaine de caractères  
     */
    function firstLetterToUpper($str){
        return ucfirst(mb_convert_case($str, MB_CASE_LOWER, "UTF-8"));
    }


    /**
     * Fonction qui met la première lettre de chaque mot d'une chaine de caractères en majucule 
     */
    function convertToTitle($str){
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
    

    /**
     * Fonction qui redirige vers une url avec une durée d'attente en ms
     */
    function redirect(string $path, int $duration){
        echo '
        <script>
            setTimeout(()=>{
                document.location.href="'.$path.'"; 
            }, '.$duration.');
        </script>';
    }


    /**
     * Fonction qui récupère le format du fichier extension
     */
    function get_file_extension($file){
        return substr(strrchr($file,'.'),1);
    }

    /**
     * Fonction qui recupere le nom d'un fichier sans l'extension
     */
    function get_file_name($file, $ext){
        return substr($file, 0, (strrpos($file, ".$ext", -1)));
    }
?>