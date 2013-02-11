<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "wcl.php";

// Создать экземпляр
$wcl = WorldClassLibrary::createInstance();

// Заполнить города
$wcl->addCity(new WCCity(array(
    "id" => 123, "name" =>  "Москва", "geoIpId" => "RU_Moscow"
)));
$wcl->addCity(new WCCity(array(
    "id" => 345, "name" =>  "Казань", "geoIpId" => "50349"
)));
$wcl->addCity(new WCCity(array(
    "id" => 678, "name" =>  "Ульяновск", "geoIpId" => "RU_Ulyanovsk"
)));

// Заполнить станции метро
$wcl->addSubway(new WCSubway(array(
    "id" => 1, "name" => "Калужская", "address" => "Метро Калужская", "cityId" => 123
)));
$wcl->addSubway(new WCSubway(array(
    "id" => 2, "name" => "Крылатское", "address" => "Метро Крылатское", "cityId" => 123
)));
$wcl->addSubway(new WCSubway(array(
    "id" => 3, "name" => "Строгино", "address" => "Метро Строгино", "cityId" => 123
)));

// Заполнить список клубов
$wcl->addClub(new WCClub(array(
    "id" => 1, "name" => "Романов", "address" => "Улица 1, дом 1", "subwayId" => 1, "cityId" => 123, "phone" => "+7 1232 456 78", "lat" => "23.3456789", "lon" => "45.567892", "type" => "green"
)));
$wcl->addClub(new WCClub(array(
    "id" => 2, "name" => "Романовский", "address" => "Улица 2, дом 2", "subwayId" => 1, "cityId" => 123, "phone" => "+7 1232 456 79", "lat" => "23.3556789", "lon" => "45.567792", "type" => "red"
)));
$wcl->addClub(new WCClub(array(
    "id" => 3, "name" => "Клуб 3", "address" => "Улица Романова, дом 3", "subwayId" => 1, "cityId" => 123, "phone" => "+7 1532 456 78", "lat" => "23.3454789", "lon" => "45.567896", "type" => "green"
)));
$wcl->addClub(new WCClub(array(
    "id" => 4, "name" => "Клуб 4", "address" => "Улица 4, дом 4", "cityId" => 123, "phone" => "+7 1332 456 78", "lat" => "23.3656789", "lon" => "45.567492", "type" => "green"
)));
$wcl->addClub(new WCClub(array(
    "id" => 5, "name" => "Клуб 5", "address" => "Улица 5, дом 5", "subwayId" => 2, "cityId" => 123, "phone" => "+7 1232 436 78", "lat" => "23.3453289", "lon" => "45.579892", "type" => "black"
)));
$wcl->addClub(new WCClub(array(
    "id" => 6, "name" => "Клуб 6", "address" => "Улица 1, дом 1", "cityId" => 345, "phone" => "+7 9783 456 78", "lat" => "23.34879289", "lon" => "45.5634562", "type" => "green"
)));
$wcl->addClub(new WCClub(array(
    "id" => 7, "name" => "Клуб 7", "address" => "Улица 7, дом 7", "cityId" => 345, "phone" => "+7 1232 321 78", "lat" => "23.2346789", "lon" => "45.593452", "type" => "red"
)));
$wcl->addClub(new WCClub(array(
    "id" => 8, "name" => "Клуб 8", "address" => "Улица 8, дом 8", "cityId" => 678, "phone" => "+7 1461 456 78", "lat" => "23.3434589", "lon" => "45.123892", "type" => "green"
)));

// Вернуть данные в JSON
die($wcl->getWorldJSON());