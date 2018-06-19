<?php

namespace MegaDataClientBundle\Service;

/**
 * Response parser
 */
interface ContentParserInterface
{
    /**
     * Parse mega data content response
     *
     * @param string $content
     *
     * @return array
     */
    public function parse(string $content);
}