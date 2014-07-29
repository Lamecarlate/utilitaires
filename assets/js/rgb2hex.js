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
		
		var rgb_input = document.querySelector("#rgb");
		var rgb_submit = document.querySelector("#rgb-submit");
		var hex_input = document.querySelector("#hex");
		var hex_submit = document.querySelector("#hex-submit");

		var sample = document.querySelector(".color-sample .sample");

		addEvent(rgb_submit, 'click', function() {
			var new_hex = rgb2hex();
			if(new_hex) {
				hex_input.value = new_hex;
				hex_input.classList.add('new');
				var a_rgb = extract_rgb(rgb_input.value);
				sample.style.backgroundColor = format_rgb(a_rgb[0], a_rgb[1], a_rgb[2], a_rgb[3]);
			}
		});

		addEvent(hex_submit, 'click', function() {
			var new_rgb = hex2rgb();
			if(new_rgb) {
				rgb_input.value = new_rgb;
				rgb_input.classList.add('new');
				sample.style.backgroundColor = new_rgb;
			}
		});

	}

	function rgb2hex() {
		var rgb = document.querySelector("#rgb").value, 
			is_rgba = false,
			red, blue, green, alpha,
			convert_string;

		// // on nettoie la chaine
		// if(rgb.indexOf("rgb(") === 0) {
		// 	rgb = rgb.substring(4);
		// }
		// if(rgb.indexOf("rgba(") === 0) {
		// 	rgb = rgb.substring(5);
		// 	is_rgba = true;
		// }
		// var end_parenthesis_pos = rgb.indexOf(")");
		// if(end_parenthesis_pos !== -1) {
		// 	rgb = rgb.substring(0,end_parenthesis_pos);
		// }

		// var a_rgb = rgb.split(',');
		// var a_rgb_length = a_rgb.length;
		// if(a_rgb_length === 4) {
		// 	is_rgba = true;
		// 	// ok, on continue
		// }
		// else if(a_rgb_length === 3) {
		// 	// ok, on continue
		// }
		// else {
		// 	return false;
		// }
		// 
		
		var a_rgb = extract_rgb(rgb);

		//console.log(a_rgb);

		if(!a_rgb) {
			return false;
		}

		if(a_rgb.length === 4) {
			is_rgba = true;
		}

		red = parseInt(a_rgb[0]);
		green = parseInt(a_rgb[1]);
		blue = parseInt(a_rgb[2]);

		if(is_rgba) { 
			alpha = parseInt((parseFloat(a_rgb[3]) >= 1 ? 1 : parseFloat(a_rgb[3])) * 255);
			convert_string = "#" + _2hex(red) + _2hex(green) + _2hex(blue) + _2hex(alpha);
		}
		else {
			convert_string = "#" + _2hex(red) + _2hex(green) + _2hex(blue);
		}

		return convert_string;

	}

	function extract_rgb(rgb) {

		//console.log(rgb);

		if(rgb.indexOf("rgb(") === 0) {
			rgb = rgb.substring(4);
		}
		if(rgb.indexOf("rgba(") === 0) {
			rgb = rgb.substring(5);
			is_rgba = true;
		}
		var end_parenthesis_pos = rgb.indexOf(")");
		if(end_parenthesis_pos !== -1) {
			rgb = rgb.substring(0,end_parenthesis_pos);
		}

		//console.log(rgb);

		var a_rgb = rgb.split(',');

		//console.log(a_rgb);
		//console.log(a_rgb.length);
		var a_rgb_length = a_rgb.length;
		if(a_rgb_length !== 4 && a_rgb_length !== 3) {
			return false;
		}
		else {
			return a_rgb;
		}		

	}

	function _2hex(c) {
		var hex = c.toString(16);
    	return hex.length == 1 ? "0" + hex : hex;
	}

	function hex2rgb() {
		var hex = document.querySelector("#hex").value,
			is_rgba = false,
			red, green, blue, alpha,
			convert_string;

		hex = (hex.indexOf("#") === 0) ? hex.substring(1) : hex ;

		var hex_length = hex.length;

		if(hex_length === 8) {
			red = hex.substring(0,2);
			green = hex.substring(2,4);
			blue = hex.substring(4,6);
			alpha = hex.substring(6,8);
			is_rgba = true;
		}
		else if(hex_length === 6) {
			red = hex.substring(0,2);
			green = hex.substring(2,4);
			blue = hex.substring(4,6);
		}
		else if(hex_length === 3) {
			red = hex.substring(0,1);
			red = red + red;
			green = hex.substring(1,2);
			green = green + green;
			blue = hex.substring(2,3);
			blue = blue + blue;
		}
		else {
			return false; // error
		}

		if(is_rgba) {
			convert_string = format_rgb(parseInt(red,16), parseInt(green,16), parseInt(blue,16), (parseInt(alpha,16) / 255).toFixed(2));
		}
		else {
			convert_string = format_rgb(parseInt(red,16), parseInt(green,16), parseInt(blue,16));
		}

		return convert_string;
				
	}

	function format_rgb(red, green, blue, alpha) {
		if(typeof(alpha) !== 'undefined' && alpha !== null) {
			return "rgba(" + red + "," + green + "," + blue + "," + alpha + ")";
		}
		else {
			return "rgb(" + red + "," + green + "," + blue + ")";
		}
	}

})();