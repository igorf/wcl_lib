<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 04.02.13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */
class WcIdException extends Exception {
    const EXCEPTION_ID = 10001;
    const EXCEPTION_TEXT = "ID MUST be set";

    public function __construct() {
        parent::__construct(self::EXCEPTION_TEXT, self::EXCEPTION_ID, null);
    }
}
