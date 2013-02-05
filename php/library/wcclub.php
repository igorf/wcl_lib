<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 11:23
 * To change this template use File | Settings | File Templates.
 */
class WCClub implements WCSerializable {

    private $id;
    private $name;
    private $address;
    private $cityId;
    private $wcWorld;

    public function getSerializableObject() {
        $r = new stdClass();
        $r->id = $this->getId();
        $r->name = $this->getName();
        $r->address = $this->getAddress();
        $r->cityId = $this->getCityId();

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
        if (!intval($this->id) >= 0) {
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
}
