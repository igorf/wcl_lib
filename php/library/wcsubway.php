<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 11:25
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcserializable.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcobject.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "exception" . DIRECTORY_SEPARATOR . "wcidexception.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcworld.php";

class WCSubway extends WCObject implements WCSerializable {
    protected $fields = array("id", "name", "address", "cityId");
    private $id;
    private $name;
    private $address;
    private $wcWorld;
    private $cityId;
    private $clubList = array();

    public function getSerializableObject() {
        $r = new stdClass();
        $r->id = $this->getId();
        $r->name = $this->getName();
        $r->address = $this->getAddress();
        $r->cityId = $this->getCityId();
        $r->clubList = array_unique($this->getClubList());
        return $r;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        if (intval($this->id) <= 0) {
            throw new WcIdException();
        }
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setWorld(WCWorld $wcWorld) {
        $this->wcWorld = $wcWorld;
    }

    public function getWorld() {
        return $this->wcWorld;
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getCityId() {
        return $this->cityId;
    }

    private function getClubList() {
        return $this->clubList;
    }

    public function addClub(WCClub $club) {
        $this->clubList []= $club->getId();
    }
}
