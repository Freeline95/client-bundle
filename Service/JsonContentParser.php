<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 19.06.2018
 * Time: 23:10
 */

namespace MegaDataClientBundle\Service;

use GuzzleHttp;

/**
 * Parser response content in json format
 */
class JsonContentParser implements ContentParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(string $content)
    {
        return json_decode($content, true);
    }
}