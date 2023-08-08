<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // "ILLuminate" corregido a "Illuminate"
use Illuminate\Routing\Controller as BaseController; // Importar la clase base del controlador

class WaController extends BaseController // Extender BaseController en lugar de Controller
{
    public function envia(Request $request) // Agregar parámetro Request
    {
        // TOKEN QUE NOS DA FACEBOOK
        $token="EAALkEjCoYOQBO5lHXZCvk4Um2hVHJaXMqOSE9o1Mzs0zZAAQke18ZCiwtXWad8YtGZCbljLJJ3asP5EhyE0GtcQjZAuZAsY06I0ZCJ7CXmM3MXxtUdVcU04tcC3V8LKE66I5yL5gwfm5MlGeYquR7bKVnOspEjLMZAZBQvzHmIZAnLsOMmQbu9fm0Eozt4sA9R78hl2h1GsNMQYwa0JYmxpAZDZD";

        // NUESTRO TELEFONO
        $telefono = '573143960806';
        
        // URL A DONDE SE MANDARA EL MENSAJE
        $url = 'https://graph.facebook.com/v17.0/103975566134311/messages';

        // CONFIGURACION DEL MENSAJE        
	$mensaje = [
	    "messaging_product" => "whatsapp",
	    "to" => $telefono,
	    "type" => "template",
	    "template" => [
		"name" => "primer_mensaje",
		 "language" => ["code" => "es"]
	    ]
	];
        
        // DECLARAMOS LAS CABECERAS
        $header = [
            "Authorization: Bearer " . $token,
            "Content-Type: application/json" // Corregido a "application/json"
        ];

        // INICIAMOS EL CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($mensaje)); // Convertir a JSON
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
        $response = json_decode(curl_exec($curl), true);

        // IMPRIMIMOS LA RESPUESTA
        print_r($response); // Corregido a "$response"

        // OBTENEMOS EL CODIGO DE LA RESPUESTA
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // CERRAMOS EL CURL
        curl_close($curl);
    }
}

