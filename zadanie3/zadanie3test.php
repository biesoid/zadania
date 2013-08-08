<?php

require_once('zadanie3.php');

// zapisanie rekordów
$osoba = new Osoba();

$osoba->imie = 'Wojciech';
$osoba->nazwisko = 'Bajcar';
$osoba->wiek = 30;
$osoba->zapisz();

$osoba = new Osoba();

$osoba->imie = 'Milton';
$osoba->nazwisko = 'Friedman';
$osoba->wiek = 90;
$osoba->zapisz();

$osoba = new Osoba();

$osoba->imie = 'Mark';
$osoba->nazwisko = 'Skousen';
$osoba->wiek = 55;
$osoba->zapisz();

$osoba = new Osoba();

$osoba->imie = 'Peter';
$osoba->nazwisko = 'Schiff';
$osoba->wiek = 45;
$osoba->zapisz();


// odczytanie rekordu o podanym id
$osoba = new Osoba(3);


// edycja rekordu
$osoba = new Osoba();

$osoba->id = 4;
$osoba->imie = 'Piotr'; // zmieniony
$osoba->nazwisko = 'Schiff';
$osoba->wiek = 48; // zmieniony
$osoba->zapisz();


// usunięcie rekordu o podanym id
$osoba = new Osoba();
$osoba->usun(1);

// wylistowanie wszystkich rekordów
Osoba::listuj();