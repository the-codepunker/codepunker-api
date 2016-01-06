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
        $key = getenv('api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['api_key'];
        }
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key
        ];

        $this->client->setParams($params);
    }

    /**
     * test set request params
     */
    public function testsetParams()
    {
        $key = getenv('api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['api_key'];
        }
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key,
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
        $key = getenv('api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['api_key'];
        }
        $response = $this->client->getToken();
        $this->assertEquals(true, $response);
        $this->assertNotEmpty($this->client->token);
    }

    /**
     * testServit
     */
    public function testServit()
    {
        $key = getenv('api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['api_key'];
        }
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key,
            'assets'=>['https://news.ycombinator.com/news.css']
        ];
        $client = new \Codepunker\CodepunkerApi\ServIt;
        $client->setParams($params);
        $client->getToken();
        $outcome = $client->pushToCDN();

        $this->assertEquals($outcome->type, $client::SUCCESS_MESSAGE);
    }

    /**
     * testuglify
     */
    public function testUglify()
    {
        $key = getenv('api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['api_key'];
        }
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key,
            'assets'=>['https://www.codepunker.com/src/tools.js'],
            'language'=>'JavaScript',
            'pushtocdn'=>'true',
        ];
        $client = new \Codepunker\CodepunkerApi\Uglify;
        $client->setParams($params);
        $client->getToken();
        $outcome = $client->uglify();

        $this->assertEquals($outcome->type, $client::SUCCESS_MESSAGE);
    }
}
