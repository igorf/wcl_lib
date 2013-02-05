<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 30.01.13
 * Time: 17:11
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . "wcserializable.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcworld.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "exception" . DIRECTORY_SEPARATOR . "wcidexception.php";

class WCCity implements WCSerializable {
    private $id;
    private $name;
    private $geoIpId;
    private $wcWorld = null;

    public function getId() {
        if (!intval($this->id) >= 0) {
            throw new WcIdException();
        }
        return intval($this->id);
    }

    public function getName() {

    }

    public function getGeoIpId() {

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

    public function getSerializableObject() {
        $r = new stdClass();
        $r->id = $this->getId();
        $r->name = $this->getName();
        $r->alias = $this->getGeoIpId();
        return $r;
    }
}