<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "library" . DIRECTORY_SEPARATOR . "worldclasslibraryimpl.php";

class WorldClassLibrary {
    public static function createInstance($params = null) {
        return new WorldClassLibraryImpl($params);
    }
}