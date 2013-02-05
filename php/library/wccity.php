<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 30.01.13
 * Time: 17:11
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcserializable.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcobject.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "exception" . DIRECTORY_SEPARATOR . "wcidexception.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcworld.php";

class WCCity extends WCObject implements WCSerializable {
    protected $fields = array("id", "name", "geoIpId");
    private $id;
    private $name;
    private $geoIpId;
    private $wcWorld = null;
    private $subwayList = array();
    private $clubList = array();

    public function getId() {
        if (intval($this->id) <= 0) {
            throw new WcIdException();
        }
        return intval($this->id);
    }

    public function getName() {
        return $this->name;
    }

    public function getGeoIpId() {
        return $this->geoIpId;
    }

    public function setGeoIpId($geoIpId) {
        $this->geoIpId = $geoIpId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setWorld($wcWorld) {
        $this->wcWorld = $wcWorld;
    }

    public function getWorld() {
        return $this->wcWorld;
    }

    public function addClub(WCClub $club) {
        $this->clubList []= $club->getId();
    }

    private function getClubList() {
        return $this->clubList;
    }

    public function addSubway(WCSubway $subway) {
        $this->subwayList []= $subway->getId();
    }

    private function getSubwayList() {
        return $this->subwayList;
    }

    public function getSerializableObject() {
        $r = new stdClass();
        $r->id = $this->getId();
        $r->name = $this->getName();
        $r->alias = $this->getGeoIpId();
        $r->subwayList = array_unique($this->getSubwayList());
        $r->clubList = array_unique($this->getClubList());
        return $r;
    }
}