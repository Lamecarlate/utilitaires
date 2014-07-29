;(function(){

	"use strict";

	function addLoadListener(func) {
		if (window.addEventListener) {
			window.addEventListener("load", func, false);
		} else if (document.addEventListener) {
			document.addEventListener("load", func, false);
		} else if (window.attachEvent) {
			window.attachEvent("onload", func);
		}
	}

	addLoadListener(init);

	var addEvent = (function () {
	    var filter = function(el, type, fn) {
	        for ( var i = 0, len = el.length; i < len; i++ ) {
	            addEvent(el[i], type, fn);
	        }
	    };
	    if ( document.addEventListener ) {
	        return function (el, type, fn) {
	            if ( el && el.nodeName || el === window ) {
	                el.addEventListener(type, fn, false);
	            } else if (el && el.length) {
	                filter(el, type, fn);
	            }
	        };
	    }
	 
	    return function (el, type, fn) {
	        if ( el && el.nodeName || el === window ) {
	            el.attachEvent('on' + type, function () { return fn.call(el, window.event); });
	        } else if ( el && el.length ) {
	            filter(el, type, fn);
	        }
	    };
	})();

	function init() {
		
		// var inputs = document.querySelectorAll(".dice");

		// var form = document.querySelector('#throw-dice');
		// addEvent(form, 'submit', function(event) {
		// 	if (event.preventDefault) {
		// 		event.preventDefault();
		// 	}
		// 	event.returnValue = false;
		// 	throw_dice();
		// });


	}

	function throw_dice() {

		var inputs = document.querySelectorAll(".dice"),
			chosen = get_checked_radio(),
			sent_data = "dice_type=" + chosen;

			console.log(sent_data);

		var r = open_ajax_request();
		r.open("GET", 'dice');
		r.onreadystatechange = function (data) {
			if (r.readyState != 4 || r.status != 200) {
				return;
			} 
			console.log('yay');
		}; 
		r.send(sent_data);
		
		//makeRequest('dice', sent_data);
	}

	function get_checked_radio() {
		var radios = document.getElementsByName('dice_type');

		for (var i = 0, length = radios.length; i < length; i++) {
		    if (radios[i].checked) {
		        // do whatever you want with the checked radio
		        return radios[i].value;

		        // only one radio can be logically checked, don't check the rest
		        break;
		    }
		}
	}

	function open_ajax_request() {
		var httpRequest;
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		    httpRequest = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE 8 and older
		    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return httpRequest;
	}


	function makeRequest(url, data) {
		var httpRequest;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
      httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
      try {
        httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } 
      catch (e) {
        try {
          httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        catch (e) {}
      }
    }

    if (!httpRequest) {
      alert('Giving up :( Cannot create an XMLHTTP instance');
      return false;
    }
    httpRequest.onreadystatechange = function(){alertContents(httpRequest);};
    httpRequest.open('POST', url);
    httpRequest.send(data);
  }

  function alertContents(httpRequest) {
    if (httpRequest.readyState === 4) {
      if (httpRequest.status === 200) {
        alert(httpRequest.responseText);
      } else {
        alert('There was a problem with the request.');
      }
    }
  }

})();