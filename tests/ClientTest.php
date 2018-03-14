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
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $params = [
            'api_key'=>$key
        ];

        $this->client->setParams($params);
    }

    /**
     * test set request params
     */
    public function testsetParams()
    {
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $params = [
            'api_key'=>$key,
        ];

        $this->client->setParams($params);

        $this->assertEquals($params['api_key'], $this->client->api_key);
    }


    /**
     * test get token success
     */
    public function testgetToken()
    {
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $response = $this->client->getToken();
        $this->assertEquals(true, $response);
        $this->assertNotEmpty($this->client->token);
    }

    /**
     * testsitemapgen
     */
    public function testSitemapGen()
    {
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $params = [
            'api_key'=>$key,
            'domain'=>'https://hosting.codepunker.com',
            'callbackuri'=>'https://hookb.in/Z6OOR3Pg',
        ];
        $client = new \Codepunker\CodepunkerApi\SitemapGen;
        $client->setParams($params);
        $client->getToken();
        $outcome = $client->run();

        $this->assertEquals($outcome->type, $client::SUCCESS_MESSAGE);
    }

    /**
     * testStringConverter
     */
    public function testStringConverter()
    {
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $methods = [
            "encode"=>"a& b=",
            "decode"=>"cXdlMTIzNCAm",
            "hash"=>"qwe1234",
            "unhash"=>"020a66797188c675989262ffff701e11"
        ];
        foreach ($methods as $method => $string) {
            $params = [
                'api_key'=>$key,
                'method'=>$method,
                'string'=>$string,
            ];
            $client = new \Codepunker\CodepunkerApi\StringConverter;
            $client->setParams($params);
            $client->getToken();
            $outcome = $client->run();
            $this->assertEquals($outcome->type, $client::SUCCESS_MESSAGE);
        }
    }
}
