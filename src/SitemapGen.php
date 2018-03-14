<?php

namespace Codepunker\CodepunkerApi;

use GuzzleHttp\Client as Guzzle;

class SitemapGen extends \Codepunker\CodepunkerApi\Client
{
    /**
     * @var array an array of asset URLs to be uglified
     */
    public $domain = "";
    public $freq = "never";
    public $callbackuri = "";
    public $execute = "executeSitemapGenerator";

    /**
     * Queries the CodepunkerApi asking to generate a sitemap
     * for a specified URL/Website ... 
     * A callback URL is required for when the sitemap is ready for download
     * @return string a json with the API response
     */
    public function run()
    {
        $client = new Guzzle();
        $response = $client->request('POST', $this->base_uri, [
            'form_params' => [
                'execute'=>$this->execute,
                'domain'=>$this->domain,
                'freq'=>$this->freq,
                'callbackuri'=>$this->callbackuri,
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
