<?php

namespace Codepunker\CodepunkerApi;

use GuzzleHttp\Client as Guzzle;

class ServIt extends \Codepunker\CodepunkerApi\Client
{
    /**
     * @var array an array of asset URLs to be pushed to the cdn
     */
    public $assets = [];

    /**
     * Queries the CodepunkerApi asking to push files from the requested
     * URLs to the servIt CDN
     * @return string a json with the API response
     */
    public function pushToCDN()
    {
        $client = new Guzzle();
        $response = $client->request('POST', $this->base_uri, [
            'form_params' => [
                'execute'=>'executeCDN',
                'token'=>$this->token,
                'urlcode'=>$this->assets
            ]
        ]);

        $msg = "Remote connection couldn't be established. HTTP Status code: ";
        if ($response->getStatusCode()!==200) {
            throw new Exceptions\CodepunkerExceptions($msg . $response->getStatusCode());
        }

        return $response->getBody();
    }
}
