<?php

class WorldClassLibrary {
    public static function createInstance($params = null) {
        return new WorldClassLibraryImpl($params);
    }
}