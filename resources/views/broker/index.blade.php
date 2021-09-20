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

      client.subscribe('values', { qos:0 }, (error) => {
        if (error) {
          console.log('Suscripcion exitosa');
        }else {
          console.log('Suscrpcion fallida');
        }
      })

      client.publish('fabrica', 'esto es un exito!!!', (error) => {
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


</script>

