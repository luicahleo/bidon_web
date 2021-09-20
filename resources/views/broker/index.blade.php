<h1>Broker index pruebas con pull nuevo</h1>


<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
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
        username: 'web_client',
        password: '121212',

        keepalive: 60,
        clean: true,
    }

    var connected = false;

    // WebSocket connect url
    const WebSocket_URL = 'wss://trajano.es:8084/mqtt'


    const client = mqtt.connect(WebSocket_URL, options)


    client.on('connect', () => {
        console.log('Mqtt conectado por WS! Exito!')

        client.subscribe('values', {
            qos: 0
        }, (error) => {
            if (!error) {
                console.log('Suscripción exitosa!')
            } else {
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
