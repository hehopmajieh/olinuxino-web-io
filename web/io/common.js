function clone(obj) {
	if(obj === null || typeof(obj) != 'object') { return obj; }
	var temp = new obj.constructor();
	for(var key in obj) { temp[key] = clone(obj[key]); }
	return temp;
}

function buildUrl(url, args) {
	var val, sep = (url.match(/\?/g) !== null) ? "&" : "?";
	for(var name in args) {
		val = args[name];
		url += sep + encodeURIComponent(name);
		if(sep == "?") { sep = "&"; }
		if(val !== null && val !== undefined) { url += "=" + encodeURIComponent(val); }
	}
	return url;
}

function objSetAttr(obj, attr) {
	for(var n in attr) { obj[n] = attr[n]; }
	return obj;
}

var d = {
	d : document,
	w : window,
	ebi : function(i) {
		return document.getElementById(i);
	},
	ebn : function(n) {
		return document.getElementsByName(n);
	},
	febn : function(n) {
		return document.getElementsByName(n)[0];
	},
	ce : function(n) {
		return document.createElement(n);
	},
	ctn : function(n) {
		return document.createTextNode(n);
	},
	ac : function(p, c) {
		return p.appendChild(c);
	},
	ac1 : function(p, c) {
		p.appendChild(c);
		return p;
	}
	
}

function array_diff() {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Sanjoy Roy
	// +    revised by: Brett Zamir (http://brett-zamir.me)
	// *     example 1: array_diff(['Kevin', 'van', 'Zonneveld'], ['van', 'Zonneveld']);
	// *     returns 1: {0:'Kevin'}

	var arr1 = arguments[0], retArr = {};
	var k1 = '', i = 1, k = '', arr = {};

	arr1keys:
	for (k1 in arr1) {
		for (i = 1; i < arguments.length; i++) {
			arr = arguments[i];
			for (k in arr) {
				if (arr[k] === arr1[k1]) {
					// If it reaches here, it was found in at least one array, so try next value
					continue arr1keys; 
				}
			}
			retArr[k1] = arr1[k1];
		}
	}

	return retArr;
}

function array_values (input) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// *     example 1: array_values( {firstname: 'Kevin', surname: 'van Zonneveld'} );
	// *     returns 1: {0: 'Kevin', 1: 'van Zonneveld'}

	var tmp_arr = [], cnt = 0;
	var key = '';

	for ( key in input ){
		tmp_arr[cnt] = input[key];
		cnt++;
	}

	return tmp_arr;
}

function implode (glue, pieces) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Waldo Malqui Silva
	// +   improved by: Itsacon (http://www.itsacon.net/)
	// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
	// *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
	// *     returns 1: 'Kevin van Zonneveld'
	// *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
	// *     returns 2: 'Kevin van Zonneveld'

	var i = '', retVal='', tGlue='';
	if (arguments.length === 1) {
		pieces = glue;
		glue = '';
	}
	if (typeof(pieces) === 'object') {
		if (pieces instanceof Array) {
			return pieces.join(glue);
		}
		else {
			for (i in pieces) {
				retVal += tGlue + pieces[i];
				tGlue = glue;
			}
			return retVal;
		}
	}
	else {
		return pieces;
	}
}