<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
// Load class
$script_root = dirname(__FILE__);
require_once($script_root . "/../D2Tbl.class.php");

// Language
$language = "eng";

// Action
// 0 - print strings
// 1 - skills names
// 2 - mercenaries names
$action = 0;

// Get strings
$strings_cl = D2Tbl::getStrings($script_root . "/tbl/string_" . $language . ".tbl");
$strings_lod = D2Tbl::getStrings($script_root . "/tbl/expansionstring_" . $language . ".tbl");
$strings_patch = D2Tbl::getStrings($script_root . "/tbl/patchstring_113c_" . $language . ".tbl");

if(!empty($strings_cl)) {
	// Default array (classic)
	$strings = $strings_cl;

	//
	// Override strings
	//

	// Expansion
	if(!empty($strings_lod)) {
		foreach($strings_lod as $k => $v) {
			$strings[$k] = $v;
		}
	}

	// Patch
	if(!empty($strings_patch)) {
		foreach($strings_patch as $k => $v) {
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
			$skillsNames[] = "";
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
		//echo "<pre>";
		//print_r($skillsNames);
		//echo "</pre>";

		// Generate array
		$skills = "";
		$i = 0;
		foreach($skillsNames as $skill) {
			$skills .= "\"" . $skill . "\",";
			$skills .= ($i++%10 == 9 ? "<br />\r\n" : "");
		}
		echo substr($skills,0,-1);
	}
	// Mercenaries names
	elseif($action == 2) {
		$mercenariesNames = array();

		// Act I
		for($i = 1; $i < 42; $i++) {
			$mercenariesNames[] = trim($strings['merc' . ($i < 10 ? "0" : "") . $i]);
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
		echo "<tr><td>Key</td><td>Value</td></tr>\r\n";
		foreach($strings as $k => $v) {
			echo "<tr><td>" . htmlspecialchars($k,ENT_QUOTES) . "</td>"
					. "<td>" . htmlspecialchars($v,ENT_QUOTES) . "</td></tr>\r\n";
		}
		echo "</table>\r\n";
	}
}