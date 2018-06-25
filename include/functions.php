<?php
include __DIR__.'/config.php';

function ish_strip_html_table($table_rows) {
	foreach ($table_rows as $row) {
		$cols = $row->getElementsByTagName('td');
		//Timestamp from IS Handel
		$ish_timestamp = strip_tags(DOMinnerHTML($cols->item(2)));
		if (!strpos($ish_timestamp,'Heute')) {
			$wday_de[0] = 'So';
			$wday_de[1] = 'Mo';
			$wday_de[2] = 'Di';
			$wday_de[3] = 'Mi';
			$wday_de[4] = 'Do';
			$wday_de[5] = 'Fr';
			$wday_de[6] = 'Sa';
			
			$w_today = date('w');
			
			$ish_timestamp = str_replace('Heute',$wday_de[$w_today].'. '.date('d.m.'),$ish_timestamp);
		}
		//Headline
		$ish_headline = get_str(DOMinnerHTML($cols->item(1)),"strong");
		echo $ish_timestamp.' - '.$ish_headline.'<br>';
	}
}


function parseTable($html) {
	// a new dom object
	$dom = new domDocument;

	//load the html into the object
	$dom->loadHTML($html);

	//discard white space
	$dom->preserveWhiteSpace = false;

	//get the table by its tag name
	$tables = $dom->getElementsByTagName('table');

	//get all rows from the table
	$rows = $tables->item(0)->getElementsByTagName('tr');

	return $rows;
}

//return each DOM node as string
function DOMinnerHTML(DOMNode $element) { 
	$innerHTML = "";
	$children  = $element->childNodes;

	foreach ($children as $child) 
	{ 
		$innerHTML .= $element->ownerDocument->saveHTML($child);
	}

	return $innerHTML;
}

//return string between HTML tags
function get_str($string, $tag) {
	$content ="/<$tag>(.*?)<\/$tag>/";
	preg_match($content, $string, $text);
	return $text[1];
}

?>
