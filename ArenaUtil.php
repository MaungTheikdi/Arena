<?php

date_default_timezone_set('Asia/Yangon');

class ArenaUtil {

    public static function formatCardNumber($number) {
        return implode(' ', str_split($number, 4));
    }

    public static function getNext7Days() { 
        $dates = []; 
        $today = new DateTime(); 
        for ($i = 0; $i < 7; $i++) { 
            $dates[] = clone $today; 
            $today->modify('+1 day'); 
        } 
        return $dates; 
    }

    public static function checkStartWith($string, $char) {
        return strpos($string, $char) === 0;
    }

    function transformPackageDescriptions($input) {
        // Split the string by ", " to get individual items
        $items = explode(", ", $input);
        $result = [];
        $currentGroup = [];
        $currentPersons = "";
    
        foreach ($items as $item) {
            if (strpos($item, "persons") !== false) {
                // Save the previous group if it exists
                if (!empty($currentGroup)) {
                    $result[] = $currentPersons . ", " . implode(", ", $currentGroup);
                    $currentGroup = [];
                }
                $currentPersons = $item;
            } else {
                $currentGroup[] = $item;
            }
        }
    
        // Add the last group
        if (!empty($currentGroup)) {
            $result[] = $currentPersons . ", " . implode(", ", $currentGroup);
        }
    
        // Join groups with a new line
        return implode(",\n", $result);
    }
}

?>
