function WCMapLib(settings) {
    this.settings = settings;
    this.wcWorld = {};

    /**
     * Считывает данные с сервера,
     * генерирует события onReadFinish, onReadError
     */
    this.readRemoteData = function() {
        var target = this;
        $.ajax({
            url: target.settings.worldURL,
            dataType: 'json',
            success: function (answer) {
                target.wcWorld = target._convertJSONObject(answer);
                if (typeof target.settings.onReadFinish == 'function') {
                    target.settings.onReadFinish(target.wcWorld);
                }
            },
            error: function() {
                if (typeof target.settings.onReadError == 'function') {
                    target.settings.onReadError();
                }
            }
        });
    };

    /**
     * Преобразовывает пришедший JSON объект в работоспособный вид
     * @param jsonObject (wcWorld)
     * @return {Object} wcWorld
     * @private
     */
    this._convertJSONObject = function(jsonObject) {

        jsonObject.selectedCityID = -1;

        /**
         * Инициализирует внутренние объекты
         * @private
         */
        jsonObject._init = function() {
            for (var clubID in this.clubList) {
                var club = this.getClubByID(clubID);
                club.world = this;

                /**
                 * Возвращает текущее географическое размещение клуба
                 * @return {Array[lon, lat]}
                 */
                club.getLocation = function() {
                    var result = new Array();
                    result.push(this.lon);
                    result.push(this.lat);
                    return result;
                };

                /**
                 * Возвращает соответствует ли клуб строке поиска
                 * @param wildcard
                 * @return {Boolean}
                 */
                club.isMatch = function(name) {
                    var wildcard = new RegExp(name, 'i');
                    return (this.address.match(wildcard) || this.name.match(wildcard));
                }
            }

            for (var subwayID in this.subwayList) {
                var subway = this.getSubwayByID(subwayID);
                subway.world = this;

                /**
                 * Список клубов на данной станции метро
                 * @return {Array[Club Object]}
                 */
                subway.getClubList = function() {
                    var result = new Array();
                    if (this.clubList) {
                        for (var i = 0; i < this.clubList.length; i++) {
                            var cID = this.clubList[i];
                            result.push(this.world.getClubByID(cID));
                        }
                    }
                    return result;
                };
            }

            for (var cityID in this.cityList) {
                var city = this.getCityByID(cityID);
                city.world = this;

                /**
                 * Возвращает список станций метро
                 * @return {Array[Subway Object]}
                 */
                city.getSubwayList = function() {
                    var result = new Array();
                    if (this.subwayList) {
                        for (var i = 0; i < this.subwayList.length; i++) {
                            result.push(this.world.getSubwayByID(this.subwayList[i]));
                        }
                    }
                    return result;
                };

                /**
                 * Возвращает список клубов
                 * @return {Array[Club Object]}
                 */
                city.getClubList = function() {
                    var result = new Array();
                    if (this.clubList) {
                        for (i = 0; i < this.clubList.length; i++) {
                            result.push(this.world.getClubByID(this.clubList[i]));
                        }
                    }
                    return result;
                };

                /**
                 * Возвращает список клубов по строке
                 * поиск по имени, адресу
                 * @param clubWildcard String
                 */
                city.findClubs = function(clubWildcard) {
                    var result = new Array();
                    for (var cID in this.world.clubList) {
                        var club = this.world.getClubByID(cID);
                        if (club.isMatch(clubWildcard)) {
                            result.push(club);
                        }
                    }
                    return result;
                };

                /**
                 * Возвращает соответствует ли город имени
                 * @param name
                 * @return {Boolean}
                 */
                city.isMatchName = function(name) {
                    //TODO: Fixme; Подумать о более интелектуальном поиске по имени
                    return this.name == name;
                };
            }
        };

        /**
         * Устанавливает город, выбранный на карте
         * @param cityID
         */
        jsonObject.setSelectedCityID = function(cityID) {
            this.selectedCityID = cityID;
        };

        /**
         * Получает город, на который в текущий момент показывает карта
         * @return {City Object}
         */
        jsonObject.getSelectedCity = function() {
            return this.getClubByID(this.selectedCityID);
        };

        /**
         * Возвращает город по имени
         * @param name
         * @return {Object}
         */
        jsonObject.findCityByName = function(name) {
            for (var cityID in this.cityList) {
                var city = this.getCityByID(cityID);
                if (city && city.isMatchName(name)) {
                    return city;
                }
            }
        };

        /**
         * Возвращает есть ли город текущего пользователя в списке городов
         * @return {Boolean}
         */
        jsonObject.cityFound = function() {
            return (this.currentCityId != -1 && this.cityList[this.currentCityId] != undefined);
        };

        /**
         * Возвращает город, в котором сейчас находится пользователь если он есть
         * @return {Object | null}
         */
        jsonObject.getUserCity = function() {
            return this.cityList[this.currentCityId];
        };

        /**
         * Возвращает город по идентификатору
         * @param id
         * @return {Object}
         */
        jsonObject.getCityByID = function(id) {
            return this.cityList[id];
        };

        /**
         * Возвращает метро по идентификатору
         * @param id
         * @return {Object}
         */
        jsonObject.getSubwayByID = function(id) {
            return this.subwayList[id];
        };

        /**
         * Возвращает клуб по идентификатору
         * @param id
         * @return {Object}
         */
        jsonObject.getClubByID = function(id) {
            return this.clubList[id];
        };

        jsonObject._init();

        return jsonObject;
    };
}

