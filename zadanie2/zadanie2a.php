<?php

require('Zend/Dom/Query.php');

function pr($array = array()) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function getKursy($rok, $miesiac) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://nbp.pl/transfer.aspx?c=/ascx/listaabch.ascx&Typ=a&p=rok;mies&navid=archa');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array('rok' => substr($rok, -2), 'mies' => $miesiac));

	$document = curl_exec($ch);

	$dom = new Zend_Dom_Query($document);

	$table = $dom->query('ul.archl li');

	$tableList = array();

	foreach ($table as $row) {
		$tableList[substr($row->nodeValue, 10, -18)] = 'http://nbp.pl'.$row->firstChild->getAttribute('href');
	}

	return $tableList;

}

pr(getKursy('2005', '01'));
