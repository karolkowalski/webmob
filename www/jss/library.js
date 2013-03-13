var library = new Object();

library.isStorageSupported = function() {
	if (typeof(Storage) !== "undefined") {
		return true;
	} else {
		alert('Storage unsupported');
		return false;
	}
}
library.get = function(key) {
	if (library.isStorageSupported()) {
		return localStorage[key];
	}
	return null;
}
library.getClean = function(key) {
	var value = library.get(key);
	return (value != null ? value : "");
}
library.set = function(key, value) {
	if (library.isStorageSupported()) {
		localStorage[key] = value;
	}
}
library.clear = function() {
	if (library.isStorageSupported()) {
		localStorage.clear();
	}
}
library.reset = function(key) {
	if (library.isStorageSupported()) {
		localStorage.removeItem(key);
	}
}
library.fireEvent = function(element, eventName) {
	if ("fireEvent" in element)
	    element.fireEvent("on" + eventName);
	else
	{
	    var evt = document.createEvent("HTMLEvents");
	    evt.initEvent(eventName, false, true);
	    element.dispatchEvent(evt);
	}
}


var geo = new Object();
geo.LS_LOCATION_KEY = "geoLocation";
geo.LS_ERROR_KEY = "geoError";


geo.isGeoSupported = function() {
	if (navigator.geolocation) {
		return true;
	} else {
		alert('Geolocation unsupported');
		return false;
	}
}
geo.init = function() {
	if (geo.isGeoSupported()) {
		geo.update();
	}
	return this;
}
geo.update = function() {
	if (geo.isGeoSupported()) {
		navigator.geolocation.getCurrentPosition(geo._set, geo._onError);
	}
	return this;
}
geo.get = function() {
	if (geo.isGeoSupported()) {
		var geoLocation = library.get(geo.LS_LOCATION_KEY);
		if (geoLocation != null) {
			return JSON.parse(geoLocation);
		} else {
			return null;
		}
	} else {
		return null;
	}
}
geo._set = function(position) {
	library.set(geo.LS_LOCATION_KEY, JSON.stringify(position));
	library.reset(geo.LS_ERROR_KEY);
}
geo._onError = function(error) {
	library.reset(geo.LS_LOCATION_KEY);
	switch(error.code) {
    case error.PERMISSION_DENIED:
    	library.set(geo.LS_ERROR_KEY, "User denied the request for Geolocation.");
    	break;
    case error.POSITION_UNAVAILABLE:
    	library.set(geo.LS_ERROR_KEY, "Location information is unavailable.");
    	break;
    case error.TIMEOUT:
    	library.set(geo.LS_ERROR_KEY, "The request to get user location timed out.");
    	break;
    case error.UNKNOWN_ERROR:
    	library.set(geo.LS_ERROR_KEY, "An unknown error occurred.");
    	break;
    }
}