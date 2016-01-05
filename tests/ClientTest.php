<?php

namespace Codepunker\CodepunkerApi\Test;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public $client;

    /**
     * init
     */
    public function setUp()
    {
        $this->client = new \Codepunker\CodepunkerApi\Client();

        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>'glh5i4s59vsnytiu5fswwv4nr73k10y4'
        ];

        $this->client->setParams($params);
    }

    /**
     * test set request params
     */
    public function testsetParams()
    {
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>'glh5i4s59vsnytiu5fswwv4nr73k10y4',
        ];

        $this->client->setParams($params);

        $this->assertEquals($params['base_uri'], $this->client->base_uri);
        $this->assertEquals($params['api_key'], $this->client->api_key);
    }


    /**
     * test get token success
     */
    public function testgetToken()
    {
        $response = $this->client->getToken();
        $this->assertEquals(true, $response);
        $this->assertNotEmpty($this->client->token);
    }

    /**
     * testServit
     */
    public function testServit()
    {
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>'glh5i4s59vsnytiu5fswwv4nr73k10y4',
            'assets'=>['https://news.ycombinator.com/news.css']
        ];
        $client = new \Codepunker\CodepunkerApi\ServIt;
        $client->setParams($params);
        $client->getToken();
        $outcome = json_decode($client->pushToCDN());

        $this->assertEquals($outcome->type, $client::SUCCESS_MESSAGE);
    }
}
