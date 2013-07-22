<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Diablo 2 strings extractor from tbl files</title>
    </head>
    <body>
        <div>
            <?php
            // Load class
            $scriptRoot = dirname(__FILE__);
            require_once($scriptRoot . '/../lib/D2Tbl.php');

            // Language
            $language = 'eng';

            // Action
            // 0 - print strings
            // 1 - skills names
            // 2 - mercenaries names
            $action = 0;

            // Get strings
            $stringsClassic = D2Tbl::getStrings($scriptRoot . '/tbl/string_' . $language . '.tbl');
            $stringsExpansion = D2Tbl::getStrings($scriptRoot . '/tbl/expansionstring_' . $language . '.tbl');
            $stringsPatch = D2Tbl::getStrings($scriptRoot . '/tbl/patchstring_113c_' . $language . '.tbl');

            if(!empty($stringsClassic)) {
                // Default array (classic)
                $strings = $stringsClassic;

                //
                // Override strings
                //

                // Expansion
                if(!empty($stringsExpansion)) {
                    foreach($stringsExpansion as $k => $v) {
                        $strings[$k] = $v;
                    }
                }

                // Patch
                if(!empty($stringsPatch)) {
                    foreach($stringsPatch as $k => $v) {
                        $strings[$k] = $v;
                    }
                }

                // Skills names
                if($action == 1) {
                    $skillsNames = array();

                    // Classic
                    for($i = 0; $i < 156; $i++) {
                        // Fix
                        if($i == 61) {
                            $skillsNames[] = trim($strings['skillsname' . $i]);
                            continue;
                        }
                        $skillsNames[] = trim($strings['skillname' . $i]);
                    }

                    // Empty
                    for(;$i < 217; $i++) {
                        $skillsNames[] = '';
                    }

                    // Scrolls
                    for(; $i < 221; $i++) {
                        $skillsNames[] = trim($strings['skillname' . $i]);
                    }

                    // Skip
                    $i++;

                    // Expansion
                    for(; $i < 282; $i++) {
                        $skillsNames[] = trim($strings['Skillname' . $i]);
                    }

                    // Print
                    //echo '<pre>';
                    //print_r($skillsNames);
                    //echo '</pre>';

                    // Generate array
                    $skills = '';
                    $i = 0;
                    foreach($skillsNames as $skill) {
                        $skills .= '"' . $skill . '",';
                        $skills .= ($i++%10 == 9 ? "<br />\r\n" : '');
                    }
                    echo substr($skills, 0, -1);
                }
                // Mercenaries names
                elseif($action == 2) {
                    $mercenariesNames = array();

                    // Act I
                    for($i = 1; $i < 42; $i++) {
                        $mercenariesNames[] = trim($strings['merc' . ($i < 10 ? '0' : '') . $i]);
                    }

                    // Act II - III
                    for($i = 201; $i < 242; $i++) {
                        $mercenariesNames[] = trim($strings['merca' . $i]);
                    }

                    // Act V
                    for($i = 101; $i < 168; $i++) {
                        $mercenariesNames[] = trim($strings['MercX' . $i]);
                    }

                    var_dump($mercenariesNames);
                }
                // Print
                else {
                    // Sort strings
                    ksort($strings);

                    // Print
                    echo "<table>\r\n";
                    echo "<tr style=\"text-align: left\"><th>Key</th><th>Value</th></tr>\r\n";
                    foreach($strings as $k => $v) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($k, ENT_QUOTES) . "</td>";
                        echo "<td>" . htmlspecialchars($v, ENT_QUOTES) . "</td>";
                        echo "</tr>\r\n";
                    }
                    echo "</table>\r\n";
                }
            }
            ?>
        </div>
    </body>
</html>