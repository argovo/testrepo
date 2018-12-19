<?php

function parse($file, $section, $vars = null) {
		
        clearstatcache();
        
        if (isset($GLOBALS['parser'][$section])) return $GLOBALS['parser'][basename($file)][$section];
        
        $fileLines = file($file);
        $file_i = implode('<@>', $fileLines);
        $start_i = strpos($file_i, '['.$section.']');
        $start = sizeof(explode('<@>', substr($file_i, 0, $start_i))) - 1;
        $end_i = strpos($file_i, '[/'.$section.']');
        $end = sizeof(explode('<@>', substr($file_i, 0, $end_i))) - 1;


        for ($i=$start+1; $i<=$end-1; $i++) {
                $result .= $fileLines[$i];
        }
        
        if (empty($result)) {
                return 'source: '.$file. ' is empty ('.$section.')';
        }

        $GLOBALS['parser'][basename($file)][$section] = $result;

        $result = preg_replace('!\[comment\].+\[/comment\]!s', '', $result);

        if (is_array($vars)) {
                foreach($vars as $key => $value) { 
                        $tag = "{VAR:" . $key . "}";
                        $result = str_replace($tag, $value, $result);
                }
        }

        $result = preg_replace("/{VAR:(.*)}/U", "", $result);

        return $result;
}

