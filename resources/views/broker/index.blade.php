<h1>Broker index pruebas con pull nuevo v3</h1>


<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script type="text/javascript">

/*
******************************
****** PROCESOS  *************
******************************
*/


function update_values(temp1, temp2, volts){
  $("#display_temp1").html(temp1);
  $("#display_temp2").html(temp2);
  $("#display_volt").html(volts);
}

function process_msg(topic, message){
  // ej: "10,11,12"
  if (topic == "values"){
    var msg = message.toString();
    var sp = msg.split(",");
    var temp1 = sp[0];
    var temp2 = sp[1];
    var volts = sp[2];
    update_values(temp1,temp2,volts);
  }
}

function process_led1(){
  if ($('#input_led1').is(":checked")){
    console.log("Encendido");

    client.publish('led1', 'on', (error) => {
      console.log(error || 'Mensaje enviado!!!')
    })
  }else{
    console.log("Apagado");
    client.publish('led1', 'off', (error) => {
      console.log(error || 'Mensaje enviado!!!')
    })
  }
}

function process_led2(){
  if ($('#input_led2').is(":checked")){
    console.log("Encendido");

    client.publish('led2', 'on', (error) => {
      console.log(error || 'Mensaje enviado!!!')
    })
  }else{
    console.log("Apagado");
    client.publish('led2', 'off', (error) => {
      console.log(error || 'Mensaje enviado!!!')
    })
  }
}








/*
******************************
****** CONEXION  *************
******************************
*/

// connect options
const options = {
      connectTimeout: 4000,

      // Authentication
      clientId: 'iotmc',
      //username: 'web_client',
      //password: '121212',

      keepalive: 60,
      clean: true,
}

var connected = false;

// WebSocket connect url
const WebSocket_URL = 'wss://trajano.es:8084/mqtt'


const client = mqtt.connect(WebSocket_URL, options)


client.on('connect', () => {
    console.log('Mqtt conectado por WS! Exito!')

    client.subscribe('values', { qos: 0 }, (error) => {
      if (!error) {
        console.log('Suscripción exitosa!')
      }else{
        console.log('Suscripción fallida!')
      }
    })

    // publish(topic, payload, options/callback)
    client.publish('fabrica', 'esto es un verdadero éxito', (error) => {
      console.log(error || 'Mensaje enviado!!!')
    })
})

client.on('message', (topic, message) => {
  console.log('Mensaje recibido bajo tópico: ', topic, ' -> ', message.toString())
  process_msg(topic, message);
})

client.on('reconnect', (error) => {
    console.log('Error al reconectar', error)
})

client.on('error', (error) => {
    console.log('Error de conexión:', error)
})







</script>