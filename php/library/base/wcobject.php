<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 05.02.13
 * Time: 14:20
 * To change this template use File | Settings | File Templates.
 */
class WCObject {
    protected $fields = array();

    public function __construct($data = null) {
        if (is_array($data)) {
            foreach($data as $key => $value) {
                if (in_array($key, $this->fields)) {
                    $this->setKeyValue($key, $value);
                }
            }
        }
    }

    private function setKeyValue($name, $value) {
        $methodName = "set" . $name;
        if (method_exists($this, $methodName)) {
            return $this->$methodName($value);
        }
    }
}
