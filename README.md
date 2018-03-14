# CodepunkerApi

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A package that exploits the free web development tools API provided by [codepunker.com](https://www.codepunker.com/tools)
Currently the Uglify API is the only one that is available through this package.

## Install

Via Composer

``` bash
$ composer require codepunker/codepunkerapi
```

## Usage

``` php
    <?php
    //1. Generate Sitemaps
        $key = getenv('codepunker_api_key'); //set it as an env var or in the config file
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $params = [
            'api_key'=>$key,
            'domain'=>'the url of the domain you want the sitemap generated for',
            'callbackuri'=>'the url you want to receive a notification on when the sitemap is ready for downloading',
        ];
        $client = new \Codepunker\CodepunkerApi\SitemapGen;
        $client->setParams($params);
        $client->getToken();
        $outcome = $client->run();

    //2. Encode/Decode/Hash/Unhash strings
        $key = getenv('codepunker_api_key');
        if (!$key) {
            $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
            $key = $keys['codepunker_api_key'];
        }
        $methods = ["encode"=>"a& b=", "decode"=>"cXdlMTIzNCAm", "hash"=>"qwe1234", "unhash"=>"020a66797188c675989262ffff701e11"];
        foreach ($methods as $method=>$string) {
            $params = [
                'api_key'=>$key,
                'method'=>$method,
                'string'=>$string,
            ];
            $client = new \Codepunker\CodepunkerApi\StringConverter;
            $client->setParams($params);
            $client->getToken();
            $outcome = $client->run();
        }
    ?>
```

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email info@codepunker.com instead of using the issue tracker.

## Credits

- [The Codepunker](https://www.codepunker.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/codepunker/codepunkerapi.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/the-codepunker/codepunker-api/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/codepunker/codepunkerapi
[link-travis]: https://travis-ci.org/the-codepunker/codepunker-api
