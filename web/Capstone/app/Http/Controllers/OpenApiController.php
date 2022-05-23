<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenApiController extends Controller
{
    public function getPlantName()
    {
        $response = Http::get('http://api.nongsaro.go.kr/service/garden/gardenList',[
            'apiKey'=>env("NONGSARO_API_KEY"),
            'numOfRows'=>217
        ]);
        $xmlObject = simplexml_load_string((string)$response->getBody(), NULL, LIBXML_NOCDATA);
        return $this->xmlToJson($xmlObject);
    }

    // https://intrepidgeeks.com/tutorial/php-xml-and-cdata-attributes
    protected function xmlToJson($xml)
    {
        $xml = $xml->body->items;
        $this->xmlExpandAttributes($xml);
        $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return preg_replace('/\\\\\//', '/', $json);
    }

    protected function xmlExpandAttributes($node)
    {
        if($node->count() > 0) {
            foreach($node as $child)
            {
                foreach($child->attributes() as $key => $val) {
                    $node->addChild($child->getName()."@".$key, $val);
                }
                $this->xmlExpandAttributes($child);
            }
        }
    }
}
