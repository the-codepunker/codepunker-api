<?php

namespace Codepunker\CodepunkerApi;

use GuzzleHttp\Client as Guzzle;

class Uglify extends \Codepunker\CodepunkerApi\Client
{
    /**
     * @var array an array of asset URLs to be uglified
     */
    public $assets = [];
    public $language = "JavaScript";
    public $pushtocdn = "false";

    /**
     * Queries the CodepunkerApi asking to push files from the requested
     * URLs to the servIt CDN
     * @return string a json with the API response
     */
    public function uglify()
    {
        $client = new Guzzle();
        $response = $client->request('POST', $this->base_uri, [
            'form_params' => [
                'execute'=>'executeUglify',
                'language'=>$this->language,
                'urlcode'=>$this->assets,
                'pushtocdn'=>$this->pushtocdn,
                'token'=>$this->token,
            ]
        ]);

        $msg = "Remote connection couldn't be established. HTTP Status code: ";
        if ($response->getStatusCode()!==200) {
            throw new Exceptions\CodepunkerExceptions($msg . $response->getStatusCode());
        }

        $body = json_decode($response->getBody());
        if (empty($body) || $body->type !== parent::SUCCESS_MESSAGE) {
            throw new Exceptions\CodepunkerExceptions($body->response);
        }

        return $body;
    }
}
