<?php

class D2Tbl
{
    /**
    * Get strings from tbl file, based on "credits/EnquettarM.pl" script (more info can be found there).
    * Credits to Ondo and Mephansteras.
    * 
    * @param mixed $filePath
    * @param mixed $replaceSpecialCharacters
    */
    public static function getStrings($filePath, $replaceSpecialCharacters = true)
    {
        // Check file
        if(!file_exists($filePath) || !is_readable($filePath)) {
            return false;
        }

        // Read file
        $fileData = file_get_contents($filePath);

        // Skip: 0 - 1

        // Get elements number
        $unpack = unpack('S', substr($fileData, 2, 2));
        $elementsNumber = $unpack[1];

        // Skip: 4 - 20

        // Get offsets
        $offset = 21;
        $offsets = array();
        for($i = 0; $i < $elementsNumber; $i++) {
            $unpack = unpack('S', substr($fileData, $offset, 2));
            $offsets[] = $unpack[1];
            $offset += 2;
        }

        // Initialize array
        $strings = array();

        // Read elements
        for($i = 0; $i < $elementsNumber; $i++) {
            $currentOffset = ($offset + ($offsets[$i] * 17));

            // Skip 7 bytes
            $currentOffset += 7;

            // Key offset
            $unpack = unpack('L', substr($fileData, $currentOffset, 4));
            $currentOffset += 4;
            $keyOffset = $unpack[1];

            // String offset
            $unpack = unpack('L', substr($fileData, $currentOffset, 4));
            $currentOffset += 4;
            $stringOffset = $unpack[1];

            // Key length
            $keyLength = ($stringOffset - $keyOffset);

            // String length
            $unpack = unpack('S', substr($fileData, $currentOffset, 2));
            $stringLength = $unpack[1];

            // Read key
            $key = trim(substr($fileData, $keyOffset, $keyLength));

            // Read string
            $string = trim(substr($fileData, $stringOffset, $stringLength));

            // Replace special characters
            if($replaceSpecialCharacters) {
                $key = self::replaceSpecialCharacters($key);
                $string = self::replaceSpecialCharacters($string);
            }

            // Add string
            $strings[$key] = $string;
        }

        return $strings;
    }

    /**
    * Replace some special characters (\n, \t).
    * 
    * @param mixed $text
    */
    public static function replaceSpecialCharacters($text)
    {
        return str_replace(array("\n", "\t"), array("\\n", "\\t"), $text);
    }
}
