<?php

require('Zend/Dom/Query.php');

function pr($array = array()) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function getTabela($link) {

	$id = substr($link, -11);

	$table = simplexml_load_file('http://nbp.pl/kursy/xml/'.$id.'.xml');

	foreach($table->pozycja as $pozycja) {
		$tableArray['Tabela nr '.$table->numer_tabeli.' z dnia '.$table->data_publikacji][(string) $pozycja->kod_waluty] = (string) $pozycja->kurs_sredni;
	}

	return $tableArray;

}

pr(getTabela('http://nbp.pl/home.aspx?navid=archa&c=/ascx/tabarch.ascx&n=a022z130131'));
