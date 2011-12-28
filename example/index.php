<?php
// Load class
$script_root = dirname(__FILE__);
require_once($script_root . "/../D2Tbl.class.php");

// Language
$lang = "eng";

// Get strings
$strings_cl = D2Tbl::getStrings($script_root . "/tbl/" . $lang . "_string.tbl");
$strings_lod = D2Tbl::getStrings($script_root . "/tbl/" . $lang . "_expansionstring.tbl");
$strings_patch = D2Tbl::getStrings($script_root . "/tbl/" . $lang . "_patchstring_113c.tbl");

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