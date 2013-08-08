<?php
require_once('Zend/Dom/Query.php');


function pr($array = array()) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function getMonitoring($url, $username, $password) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

	$document = curl_exec($ch);

	$currentHost = '';
	$monitoringData = array();
	$serviceTitles = array('service', 'status', 'lastcheck', 'duration', 'attempt', 'info');

	$dom = new Zend_Dom_Query($document);

	$table = $dom->query('table.status tr');

	foreach ($table as $tr) {
		if($tr->childNodes->length == 14) {
			if($tr->firstChild->nodeValue) {
				$currentHost = trim($tr->firstChild->nodeValue);
				$monitoringData[$currentHost]['services'] = array();
			}
			foreach ($tr->childNodes as $td) {			
				if((trim($td->nodeValue) != $currentHost) && (trim($td->nodeValue) != '')) {
					$serviceValues[] = trim($td->nodeValue);
				}
			}
			$serviceArray = array_combine($serviceTitles, $serviceValues);
			$serviceValues = array();
			$monitoringData[$currentHost]['services'][] = $serviceArray;
		}
	}

	return $monitoringData;
	
}

pr(getMonitoring('https://nagios.demo.netways.de/nagios/cgi-bin/status.cgi', 'guest', 'guest'));
