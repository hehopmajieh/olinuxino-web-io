/* JSFromHell.com | http://jsfromhell.com
 * ======================================
 * 
 * Name: HTTP Request v1.0
 * URI: http://jsfromhell.com/classes/http-request
 * Author: jonasraoni
 * Created: 2006.08.18
 * Modified: 2006.08.18
 * Description:
 * Class to make remote requests, which can be used on the popular "AJAX".
 * 
 * To keep yourself updated, sign up the ATOM feed at:
 * http://jsfromhell.com/atom-en.xml
 * 
 * - We don't assume any responsibility for any kind of damage, direct or indirect, that can be raised by the utilization of our site or any other site that's available through hiperlinks in our site.
 * - We authorize the copy and modification of all the codes on the site, since if you keep the original author name.
 * - In case of errors on the scripts or new feature requests, please contact the author directly.
 */

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/classes/http-request [v1.0]


HTTPRequest = function(){};
HTTPRequest.prototype = {
	isSupported : function(){
		return !!this.getConnection();
	},
	events : ["start", "open", "send", "load", "end"],
	filter : encodeURIComponent,
	getConnection : function(){
		var i, o = [function(){return new ActiveXObject("Msxml2.XMLHTTP");},
		function(){return new ActiveXObject("Microsoft.XMLHTTP");},
		function(){return new XMLHttpRequest();}];
		for(i = o.length; i--;) { try{return o[i]();} catch(e){} }
		return null;
	},
	formatParams : function(params){
		var i, r = [];
		for(i in params) { r[r.length] = i + "=" + (this.filter ? this.filter(params[i]) : params[i]); }
		return r.join("&");
	},
	get : function(url, params, handler, waitResponse){
		return this.request("GET", url + (url.indexOf("?") + 1 ? "&" : "?") + this.formatParams(params), null, handler, null, waitResponse);
	},
	post : function(url, params, handler, waitResponse){
		return this.request("POST", url, params = this.formatParams(params), handler, {
			"Connection": "close",
			"Content-Length": params.length,
			"Method": "POST " + url + " HTTP/1.1",
			"Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
		}, waitResponse);
	},
	request : function(method, url, params, handler, headers, waitResponse){
		var i, o = this.getConnection(), f = handler instanceof Function;
		//var oThis = this;
		try{
			o.open(method, url, !waitResponse);
			waitResponse || (o.onreadystatechange = function(){
				var s = HTTPRequest.prototype.events[o.readyState];
				f ? handler(o) : s in handler && handler[s](o);
			});
			if(headers){
				for(i in {USER_AGENT: 0, XUSER_AGENT: 0}) {
					i in headers || (headers[i] = "XMLHttpRequest"); }
				for(i in headers) {
					o.setRequestHeader(i, headers[i]); }
			}
			o.send(params);
			waitResponse && (f ? handler(o, oThis) : handler["end"] && handler["end"](o, oThis));
			return true;
		}
		catch(e){
			return false;
		}
	}
};