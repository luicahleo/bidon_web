<h1>Broker index pruebas con pull nuevo v3</h1>


<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>


const options = {
      connectTimeout: 4000,

      clientId: 'asd',
      keepalive: 60,
      clean: true,
    }

    const WebSocket_URL = 'wss://trajano.es:8084/mqtt'

    const client = mqtt.connect(WebSocket_URL, options)

    client.on('connect',() => {
      console.log('Mqtt conectado por WS, Exito!!!')

      client.subscribe('fabrica', { qos:0 }, (error) => {
        if (error) {
          console.log('Suscripcion exitosa');
        }else {
          console.log('Suscrpcion fallida');
        }
      })

      client.publish('values', 'esto es un exito!!!', (error) => {
        console.log(error || 'Mensaje enviado')
      })
    })

    client.on('message', (topic, message) => {
      console.log('Mensaje recibido bajo el topico: ', topic, ' -> ', message.toString());
    })

    client.on('reconnect',(error) => {
      console.log('error al reconectar', error)
    })

    client.on('error',(error) => {
      console.log('error de conexion', error)
    })



    // Globally initializes an mqtt variable
// console.log(mqtt)
//
// const clientId = 'mqttjs_a' //+ Math.random().toString(16).substr(2, 8)
// const host = 'wss://bidon.trajano.tech:8094/mqtt'
//
// const options = {
//   keepalive: 60,
//   clientId: clientId,
//   protocolId: 'MQTT',
//   protocolVersion: 4,
//   clean: true,
//   reconnectPeriod: 1000,
//   connectTimeout: 30 * 1000,
//   will: {
//     topic: 'WillMsg',
//     payload: 'Connection Closed abnormally..!',
//     qos: 0,
//     retain: false
//   },
// }
//
// console.log('Connecting mqtt client')
// const client = mqtt.connect(host, options)
//
// client.on('error', (err) => {
//   console.log('Connection error: ', err)
//   client.end()
// })
//
// client.on('reconnect', () => {
//   console.log('Reconnecting...')
// })
</script>
