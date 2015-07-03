var FancyWebSocket = function(url, id_usuario)
{
	var callbacks = {};
	var ws_url = url;
	var conn;
	var intentar=0;

	this.bind = function(event_name, callback){
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;// chainable
	};

	this.send = function(event_name, event_data){
		this.conn.send( event_data );
		return this;
	};


	this.connect = function() {
		if ( typeof(MozWebSocket) == 'function' )
			this.conn = new MozWebSocket(url);
		else
			this.conn = new WebSocket(url);
		// dispatch to the right handlers
		this.conn.onmessage = function(evt){
			dispatch('message', evt.data);//cuando hay un mensaje para mostrar
		};

		this.conn.onclose = function(){
			dispatch('close',null);
			//intentar=1;//quitar para que funcione intento de reconexion
			if(id_usuario!=null){
				intentar++;
				var url_intento="chat/server.php";
				if(id_usuario==1){
					url_intento="../chat/server.php";
				}
				var ejecutar=$.ajax({
					url: url_intento,
					type: 'POST',
					timeout:4000, 
					dataType: 'json',
					data: {},
				})
				.done(function() {
				})
				.complete(function () {
					//intento de reconexion
					console.log("intento "+intentar);
					Server.connect();
				})
			}
					
		}
		this.conn.onopen = function(){
			dispatch('open',null);
			Server.send( 'message', '{"id_usuario":"'+id_usuario+'", "action":"asignar"}');
		}
	};

	this.disconnect = function() {
		this.conn.close();
	};

	var dispatch = function(event_name, message){
		var chain = callbacks[event_name];
		if(typeof chain == 'undefined') return; // no callbacks for this event
		for(var i = 0; i < chain.length; i++){
			chain[i]( message )
		}
	}
};