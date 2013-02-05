<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 30.01.13
 * Time: 16:53
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . "worldclasslibraryinterface.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcworld.php";

class WorldClassLibraryImpl implements WorldClassLibraryInterface {

    private $world = null;

    public function __construct() {
        $this->world = WCWorld::createInstance();
    }

    public function addCity(WCCity $city) {
        $this->world->addCity($city);
    }

    public function addClub(WCClub $club) {
        $this->world->addClub($club);
    }

    public function addSubway(WCSubway $subway) {
        $this->world->addSubway($subway);
    }

    public function getUser() {
        // TODO: Implement getUser() method.
    }

    public function getWorldJSON() {
        return json_encode($this->world->getSerializableObject());
    }
}