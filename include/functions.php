<?php
include __DIR__.'/config.php';

function parseTable($html) {
    /*** a new dom object ***/
    $dom = new domDocument;
 
    /*** load the html into the object ***/
    $dom->loadHTML($html);
 
    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;
 
    /*** the table by its tag name ***/
    $tables = $dom->getElementsByTagName('table');
 
    /*** get all rows from the table ***/
    $rows = $tables->item(0)->getElementsByTagName('tr');
    
    return $rows;
}

function DOMinnerHTML(DOMNode $element) { 
    $innerHTML = "";
    $children  = $element->childNodes;

    foreach ($children as $child) 
    { 
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML; 
}

function get_str($string, $tag) {
	$content ="/<$tag>(.*?)<\/$tag>/";
	preg_match($content, $string, $text);
	return $text[1];
}


?>