<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 14:51
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "base" . DIRECTORY_SEPARATOR . "wcserializable.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "geoip" . DIRECTORY_SEPARATOR . "wcgeoipwrapper.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcclub.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wcsubway.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "wccity.php";

class WCWorld implements WCSerializable {

    const CITY_NOT_FOUND_ID = -1;

    private $cityList = array();
    private $subwayList = array();
    private $clubList = array();

    public static function createInstance() {
        return new WCWorld();
    }

    private function getCurrentCityId() {
        try {
            $wgi = WCGeoIpWrapper::getInstance();
            $cityId = $wgi->getCityId();
            if (is_null($cityId)) {
                return self::CITY_NOT_FOUND_ID;
            }
            foreach ($this->cityList as $city) {
                if ($city->getGeoIpId() == $cityId) {
                    return $city->getId();
                }
            }
        } catch (Exception $ex) {
            // Nothing to do
        }
        return self::CITY_NOT_FOUND_ID;
    }

    protected function __construct() {}

    public function addCity(WCCity $city) {
        $city->setWorld($this);
        $this->cityList[$city->getId()] = $city;
    }

    public function addSubway(WCSubway $subway) {
        $subway->setWorld($this);
        $this->subwayList[$subway->getId()] = $subway;
        if (isset($this->cityList[$subway->getCityId()])) {
            $city = $this->cityList[$subway->getCityId()];
            $city->addSubway($subway);
        }
    }

    public function addClub(WCClub $club) {
        $club->setWorld($this);
        $this->clubList[$club->getId()] = $club;

        $subwayId = $club->getSubwayId();
        $cityId = $club->getCityId();

        if (!empty($subwayId) && isset($this->subwayList[$subwayId])) {
            $subway = $this->subwayList[$subwayId];
            $subway->addClub($club);
        }

        if (isset($this->cityList[$cityId])) {
            $city = $this->cityList[$cityId];
            $city->addClub($club);
        }
    }

    private function getSerializableInternalArray($array) {
        $result = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if ($value instanceof WCSerializable) {
                    $result[$key] = $value->getSerializableObject();
                }
            }
        }
        return $result;
    }

    public function getSerializableObject() {
        $r = new stdClass();
        $r->currentCityId = $this->getCurrentCityId();
        $r->clubList = $this->getSerializableInternalArray($this->clubList);
        $r->cityList = $this->getSerializableInternalArray($this->cityList);
        $r->subwayList = $this->getSerializableInternalArray($this->subwayList);
        return $r;
    }
}
