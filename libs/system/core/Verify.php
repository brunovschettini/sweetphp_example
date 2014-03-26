    <?php

    class Verify {

        static function load() {
            $erros = array();
            // DATABASE        
            if (DB_HOST == "") {
                $erros[] = "Database error: hostname empty!";
            }
            if (DB_DATABASE == "") {
                $erros[] = "Database error: database empty!";
            }
            if (DB_USER == "") {
                $erros[] = "Database error: user empty!";
            }
            if (sizeof($erros) > 0) {
                echo "<center>";
                echo "<br /><b style='color:red;'>".sizeof($erros)." erros(s) / configuração(ões) encontrado(s)</b><br /><br />";
                echo "<ul style='list-style:none;'>";
                for ($i = 0; $i < sizeof($erros); $i++) {
                    echo "<li>".$erros[$i]."</li>";
                }
                echo "</ul>";
                echo "</center>";
                exit();
            }
        }

    }
    