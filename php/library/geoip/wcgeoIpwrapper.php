<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 05.02.13
 * Time: 18:03
 * To change this template use File | Settings | File Templates.
 */

require_once "lib/geoipcity.inc";
require_once "lib/geoipregionvars.php";

class WCGeoIpWrapper {

    const CITY_DB_NAME = "GeoLiteCity.dat";
    const DB_PATH = "static";

    private $gi;
    private static $instance = null;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new WCGeoIpWrapper();
        }
        return self::$instance;
    }

    protected function __construct() {
        $this->gi = geoip_open($this->getDbFile(), GEOIP_STANDARD);
    }

    public function getCityId() {
        $record = geoip_record_by_addr($this->gi, $this->getUserIP());
        try {
            return $record->country_code . "_" . $record->city;
        } catch (Exception $ex) {
            return null;
        }
        return null;
    }

    private function getDbFile() {
        return __DIR__ . DIRECTORY_SEPARATOR .
                self::DB_PATH . DIRECTORY_SEPARATOR .
                self::CITY_DB_NAME;
    }

    private function getUserIP() {
        return $_SERVER['REMOTE_ADDR'];
        //return "79.132.125.211";
    }
}
