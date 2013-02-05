<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 14:51
 * To change this template use File | Settings | File Templates.
 */
class WCWorld {
    private $cityList = array();
    private $subwayList = array();
    private $clubList = array();
    private $currentCity = null;

    public static function createInstance() {
        return new WCWorld();
    }

    protected function __construct() {}

    public function addCity(WCCity $city) {
        $city->setWorld($this);
        $this->cityList[$city->getId()] = $city;
    }

    public function addSubway(WCSubway $subway) {

    }

    public function addClub(WCClub $club) {
        $club->setWorld($this);
        $this->clubList[$club->getId()] = $club;
    }
}
