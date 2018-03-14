<?php

namespace Codepunker\CodepunkerApi;

use GuzzleHttp\Client as Guzzle;
use Faker;

class Client
{
    /**
     * @var  string [The API key to communicate back and forth with codepunker.com]
     */
    public $api_key;

    /**
     * @var  string [The URL where requests should be sent @codepunker.com]
     */
    public $base_uri = "https://www.codepunker.com/tools";

    /**
     * @var  token [The current API Token]
     */
    public $token;

    /**
     * @var  tokenexpires [The expiration timestamp for current token]
     */
    public $tokenexpires;

    /**
     * @var  tokenexpires [The current random string passed back and forth]
     */
    public $currentrandom;

    /**
     * @var string success message
     */
    const SUCCESS_MESSAGE = 'success';

    /**
     * Sets connection parameters
     * @param array $params should contain base_uri, api_key
     * @return void
     */
    public function setParams(array $params)
    {
        //params must at least have base_uri and api_key
        if (empty($params) || !is_array($params) || $params<2) {
            throw new Exceptions\CodepunkerExceptions("Params array must at least have the 'api_key' - 1");
        }

        foreach ($params as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new Exceptions\CodepunkerExceptions("The property {$key} is not available in the API definition");
            } else {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Obtains a valid token
     * @return [type] [description]
     */
    public function getToken()
    {
        $client = new Guzzle();
        $faker = Faker\Factory::create();
        $this->currentrandom = $faker->md5();
        $response = $client->request('POST', $this->base_uri, [
            'form_params' => [
                'execute'=>'authorizeAPI',
                'key'=>$this->api_key,
                'rand'=>$this->currentrandom
            ]
        ]);

        $msg = "Remote connection couldn't be established. HTTP Status code: ";
        if ($response->getStatusCode()!==200) {
            throw new Exceptions\CodepunkerExceptions($msg . $response->getStatusCode());
        }

        return $this->processTokenResponse($response);
    }

    /**
     * Validates a response object and puts in the current instance
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    private function processTokenResponse(\GuzzleHttp\Psr7\Response $response)
    {
        $response = $response->getBody();
        $responseobj = json_decode($response);

        $msg = "Unable to process response";
        if ($responseobj==false) {
            throw new Exceptions\CodepunkerExceptions($msg);
        }

        $msg = "The API EndPoint returned an error: ";
        if (empty($responseobj->type) || $responseobj->type!==self::SUCCESS_MESSAGE) {
            throw new Exceptions\CodepunkerExceptions($msg . $responseobj->response);
        }

        $this->token = $responseobj->response;
        $this->tokenexpires = time() + 60*60*24;

        return true;
    }
}
