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
    "id" => 1, "name" => "Клуб 1", "address" => "Улица 1, дом 1", "subwayId" => 1, "cityId" => 123
)));
$wcl->addClub(new WCClub(array(
    "id" => 2, "name" => "Клуб 2", "address" => "Улица 2, дом 2", "subwayId" => 1, "cityId" => 123
)));
$wcl->addClub(new WCClub(array(
    "id" => 3, "name" => "Клуб 3", "address" => "Улица 3, дом 3", "subwayId" => 1, "cityId" => 123
)));
$wcl->addClub(new WCClub(array(
    "id" => 4, "name" => "Клуб 4", "address" => "Улица 4, дом 4", "cityId" => 123
)));
$wcl->addClub(new WCClub(array(
    "id" => 5, "name" => "Клуб 5", "address" => "Улица 5, дом 5", "subwayId" => 2, "cityId" => 123
)));
$wcl->addClub(new WCClub(array(
    "id" => 6, "name" => "Клуб 6", "address" => "Улица 1, дом 1", "cityId" => 345
)));
$wcl->addClub(new WCClub(array(
    "id" => 7, "name" => "Клуб 7", "address" => "Улица 7, дом 7", "cityId" => 345
)));
$wcl->addClub(new WCClub(array(
    "id" => 8, "name" => "Клуб 8", "address" => "Улица 8, дом 8", "cityId" => 678
)));

// Вернуть данные в JSON
die($wcl->getWorldJSON());