<?php

require '../../vendor/autoload.php';

use Libern\QRCodeReader\QRCodeReader;

class IA
{
    public function __construct()
    {
        $this->enpoint = 'https://eastus.api.cognitive.microsoft.com/vision/v1.0/recognizeText';
        $this->key = '75bffe0b18964161a6a7f0a2a949dd2c';
    }
    public function getImage($imageUrl)
    {
        $data = json_encode(array('url' => $imageUrl));
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'https://eastus.api.cognitive.microsoft.com/vision/v1.0/recognizeText', [
            'query' => [
                'handwriting' => 'true',
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->key
            ],
            'body' => $data,
        ]);

        $p = $res->getHeader('operation-location');
        $link = json_decode(json_encode($p));
        $link = join("", $link);
        return json_decode($this->segundaParte($link, $this->key, $data), true);
    }
    public function segundaParte($link, $key, $data)
    {
        sleep(2);
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $link, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $key
            ],
            'body' => $data,
        ]);
        return $res->getBody();
    }
    public function analizarImageQr($palabras, $imageUrl)
    {
        $palabrasReserPartidos = ["UCS", "MAS", "UDN", "NULO", "BLANCO"];
        $x = '{ "palabras": ["MAS", "X", "23", "CC", "12", "BDN", "DXDD", "35"]}';
        $result3 = '{"resultados": {}}';
        $result3 = json_decode($result3, true);
        $palabrasEnFoto = [];
        $lineas = $palabras["recognitionResult"]["lines"];
        $elem = count($lineas);
        for ($i = 0; $i < $elem; $i++) {
            $elem2 = $lineas[$i]["words"];
            for ($j = 0; $j < count($elem2); $j++) {
                $elem3 = $elem2[$j]["text"];
                array_push($palabrasEnFoto, $elem3);
            }
        }

        for ($i = 0; $i < count($palabrasReserPartidos); $i++) {
            for ($j = 0; $j < count($palabrasEnFoto); $j++) {
                if (json_encode($palabrasReserPartidos[$i]) == json_encode($palabrasEnFoto[$j])) {
                    for ($k = $j + 1; $k < count($palabrasEnFoto); $k++) {
                        if (is_numeric($palabrasEnFoto[$k])) {
                            //array_push($result3["resultados"],$palabrasEnFoto[$k]);
                            $result3["resultados"][$palabrasReserPartidos[$i]] = intval($palabrasEnFoto[$k]);
                            break;
                        } else {
                            if (json_encode($palabrasEnFoto[$k]) == json_encode($palabrasReserPartidos[$i])) {
                                break;
                            } else {
                                if (in_array($palabrasEnFoto[$k], $palabrasReserPartidos)) {
                                    break;
                                } else {
                                }
                            }
                        }
                    }
                }
            }
        }
        $QRCodeReader = new QRCodeReader();
        $qrcode_text = $QRCodeReader->decode($imageUrl);
        $result3["resultados"]["MESA"] = intval($qrcode_text);
        //$result3["resultados"]["MESA"] = "12";
        return json_encode($result3);
    }
}
