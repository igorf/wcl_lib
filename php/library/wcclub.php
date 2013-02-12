<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 11:23
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcserializable.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcobject.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "exception" . DIRECTORY_SEPARATOR . "wcidexception.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcworld.php";

class WCClub extends WCObject implements WCSerializable {
    protected $fields = array("id", "name", "address", "cityId", "subwayId", "lat", "lon", "phone", "type");
    private $id;
    private $name;
    private $address;
    private $cityId;
    private $subwayId;
    private $wcWorld;
    private $lat;
    private $lon;
    private $phone;
    private $type;

    public function getSerializableObject() {
        $r = new stdClass();
        $r->id = $this->getId();
        $r->name = $this->getName();
        $r->address = $this->getAddress();
        $r->cityId = $this->getCityId();
        $r->lat = $this->getLat();
        $r->lon = $this->getLon();
        $r->phone = $this->getPhone();
        $r->type = $this->getType();

        return $r;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getCityId() {
        return $this->cityId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        if (intval($this->id) <= 0) {
            throw new WcIdException();
        }
        return intval($this->id);
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

    public function setSubwayId($subwayId) {
        $this->subwayId = $subwayId;
    }

    public function getSubwayId() {
        return $this->subwayId;
    }

    public function setLat($lat) {
        $this->lat = $lat;
    }

    public function getLat() {
        return $this->lat;
    }

    public function setLon($lon) {
        $this->lon = $lon;
    }

    public function getLon() {
        return $this->lon;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }
}
