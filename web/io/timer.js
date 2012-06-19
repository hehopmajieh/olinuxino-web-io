function Timer(interval, callback) {
	this.interval = interval;
	this.timer = null;
	this.callback = callback;
}

Timer.prototype  = {
	Start : function() {
		if(this.timer === null) {
			var othis = this;
			this.timer = window.setInterval(function() { 
				if(othis.callback !== undefined && othis.callback !== null) { 
					othis.callback(othis, this); 
				}
			}, this.interval);
		}
	},
	Stop : function() {
		if(this.timer !== null) {
			window.clearInterval(this.timer);
			this.timer = null
		}
	},
	SetInterval : function(interval) {
		this.interval = interval;
		if(this.IsRunning == true) {
			this.Stop();
			this.Start();
		}
	},
	SetCallback : function(callback) {
		this.callback = callback;
	},
	IsRunning : function() {
		return this.timer !== null;
	}
}