function WCMapLib(settings) {
    this.settings = settings;
    this.wcWorld = {};

    this.readRemoteData = function() {
        var target = this;
        $.ajax({
            url: target.settings.worldURL,
            dataType: 'json',
            success: function (answer) {
                target.wcWorld = target.convertJSONObject(answer);
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

    this.convertJSONObject = function(jsonObject) {
        jsonObject.findCityByName = function(name) {
            for (city in this.cityList) {
                if (city.name && city.name == name) {
                    return city;
                }
            }
            return undefined;
        };

        jsonObject.cityFound = function() {
            return (this.currentCityId != -1 && this.cityList[this.currentCityId] != undefined);
        };

        jsonObject.getCity = function() {
            return this.cityList[this.currentCityId];
        };

        return jsonObject;
    };
}


