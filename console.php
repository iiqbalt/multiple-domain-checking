<?php 
    class Console {
        function green($text){
            echo "\e[92m".$text."\n";
        }

        function cyan($text){
            echo "\e[96m".$text."\n";
        }

        function red($text){
            echo "\e[91m".$text."\n";
        }
        function complete($domain,$time){
            echo "\e[92mExecution \e[96m".count($domain)." domain \e[92mcomplete on \e[96m".$time." \e[92mseconds\n";
        }
    }
?>
