<?php

interface WorldClassLibraryInterface {
    public function addCity(WCCity $city);
    public function addClub(WCClub $club);
    public function addSubway(WCSubway $subway);
    public function getUser();
    public function getWorldJSON();
}