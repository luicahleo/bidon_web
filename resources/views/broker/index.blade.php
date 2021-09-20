<x-app-layout>

    <div class="container">
        <div class="card mt-6">
            <div class="card-body">
                <!-- component -->
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-wrap w-full mb-8">
                            <div class="w-full mb-6 lg:mb-0">
                                <h1 class="card-title">Nivel de agua en el deposito</h1>
                                {{-- <div class="h-1 w-2/4 bg-indigo-500 rounded"></div> --}}
                            </div>
                        </div>
                        <div class="flex flex-wrap -m-4 text-center">
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <div class="bg-indigo-500 rounded-lg p-2 xl:p-6">
                                    <h2 id="distance" class="title-font font-medium sm:text-4xl text-3xl text-white">
                                    </h2>
                                    <p class="leading-relaxed text-gray-100 font-bold">metros</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>










<script>
    /*
     ******************************
     ****** PROCESOS  *************
     ******************************
     */

    function update_values(dist) {
        $("#distance").html(dist);
    }

    function process_msg(topic, message) {
        // ej: "10,11,12"
        if (topic == "values") {
            var msg = message.toString();
            //var sp = msg.split(",");
            //var dist = sp[0];
            update_values(msg);
        }
    }

    /*
     ******************************
     ****** CONEXION  *************
     ******************************
     */
    const options = {
        connectTimeout: 4000,

        clientId: 'asd',
        keepalive: 60,
        clean: true,
    }

    const WebSocket_URL = 'wss://trajano.es:8084/mqtt'

    const client = mqtt.connect(WebSocket_URL, options)

    client.on('connect', () => {
        console.log('Mqtt conectado por WS, Exito!!!')

        client.subscribe('values', {
            qos: 0
        }, (error) => {
            if (error) {
                console.log('Suscripcion exitosa');
            } else {
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

    client.on('reconnect', (error) => {
        console.log('error al reconectar', error)
    })

    client.on('error', (error) => {
        console.log('error de conexion', error)
    })
</script>
