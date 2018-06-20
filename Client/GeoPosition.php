<?php

declare(strict_types=1);

namespace MegaDataClientBundle\Client;

use GuzzleHttp\Exception\TransferException;
use MegaDataClientBundle\Dto\LocationsDto;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use MegaDataClientBundle\Service\ContentParserInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * API for working with geo positions from MegaData
 */
class GeoPosition
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Response parser
     *
     * @var ContentParserInterface
     */
    private $responseParser;

    /**
     * Validator
     *
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * MegaData service url
     *
     * @var string
     */
    private $megaDataUrl;

    /**
     * GeoPosition constructor.
     *
     * @param LoggerInterface         $logger
     * @param ContentParserInterface  $responseParser
     * @param ValidatorInterface      $validator
     * @param string                  $megaDataUrl
     */
    public function __construct(
        LoggerInterface         $logger,
        ContentParserInterface  $responseParser,
        ValidatorInterface      $validator,
        string                  $megaDataUrl
    )
    {
        $this->logger         = $logger;
        $this->responseParser = $responseParser;
        $this->validator      = $validator;
        $this->megaDataUrl    = $megaDataUrl;
    }

    /**
     * Get locations from mega data
     *
     * @return LocationsDto|bool
     */
    public function getLocations(): LocationsDto
    {
        $client = new Client(['base_uri' => $this->megaDataUrl]);

        try {
            $response = $client->get('/locations');
        } catch (TransferException $e) {
            $this->logger->critical($e->getMessage(), $client);
            throw new TransferException('Error while connect to mega data');
        }

        $content     = $response->getBody()->getContents();
        $decodedBody = $this->responseParser->parse($content);

        if (isset($decodedBody['success']) && isset($decodedBody['data']) && $decodedBody['success'] === true) {
            // Подобные операции делаются сериализатором, но в данном случае это оверкил.
            $locationsDto = new LocationsDto();
            $locationsDto->locations = $decodedBody['data']['locations'] ?? [];

            $this->validator->validate($locationsDto);
            return $locationsDto;
        } else {
            $this->logger->critical('Mega data could not return correct response', $decodedBody);
            return false;
        }
    }
}
