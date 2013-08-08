<?php

class Osoba {

	const USERNAME = 'root';
	const PASSWORD = '';
	const HOST = 'localhost';
	const DBNAME = 'zadanie3';

	private static $db;

	public $id, $imie, $nazwisko, $wiek;
	
	public function __construct($id = null) {
		self::$db = self::dbConnect();
		if($id && is_int($id)) {
			$this->czytaj($id);
		}
	}

	private function czytaj($id) {
		$st = self::$db->prepare("SELECT * FROM `osoby` WHERE `id` = :id");
		$st->execute(array(':id' => $id));
		foreach ($st as $row) {
	        $this->id = $row['id'];
	        $this->imie = $row['imie'];
	        $this->nazwisko = $row['nazwisko'];
	        $this->wiek = $row['wiek'];
    	}
    	echo '<pre>';
    	print_r($this);
    	echo '</pre>';
	}

	public function zapisz() {
		if(!$this->id || !is_int($this->id)) {
			$st = self::$db->prepare("INSERT INTO `osoby` (`imie`, `nazwisko`, `wiek`) 
				VALUES(:imie, :nazwisko, :wiek)");
			$st->execute(array(':imie' => $this->imie, ':nazwisko' => $this->nazwisko, ':wiek' => $this->wiek));
		}
		else {
			$st = self::$db->prepare("UPDATE `osoby` SET `imie` = :imie, 
				`nazwisko` = :nazwisko, `wiek` = :wiek 
				WHERE `id` = :id");
			$st->execute(array(':imie' => $this->imie, ':nazwisko' => $this->nazwisko, 
				':wiek' => $this->wiek, ':id' => $this->id));
		}
	}

	public function usun($id = null) {
		if($id) {
			$st = self::$db->prepare("DELETE FROM `osoby` WHERE `id` = :id");
			$st->execute(array(':id' => $id));
		}
	}

	private static function dbConnect() {
		try {
			return new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME, self::USERNAME, self::PASSWORD);
		}
		catch (PDOException $e) {
			echo "Error: {$e->getMessage()}";
		}
	}

	public static function listuj() {
		self::$db = self::dbConnect();
		$st = self::$db->prepare("SELECT * FROM `osoby`");
		$st->execute();
		echo '<pre>';
		print_r($st->fetchAll(PDO::FETCH_ASSOC));
		echo '</pre>';
	}

}
