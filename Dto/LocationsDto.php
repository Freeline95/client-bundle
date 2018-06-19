<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 19.06.2018
 * Time: 22:46
 */

namespace MegaDataClientBundle\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dto for geo position client
 */
class LocationsDto
{
    /**
     * @Assert\All({
     *     @Assert\Collection(
     *          fields = {
     *              "name" = @Assert\NotBlank(),
     *              "coordinates" = {
     *                  @Assert\Collection(
     *                      fields = {
     *                          "lat" = @Assert\Range(
     *                                min = -90,
     *                                max = 90,
     *                                minMessage = "Lat cant be less than -90",
     *                                maxMessage = "Lat cant be greater than 90"
     *                          ),
     *                          "lat" = @Assert\Range(
     *                                min = -180,
     *                                max = 180,
     *                                minMessage = "Lat cant be less than -180",
     *                                maxMessage = "Lat cant be greater than 180"
     *                          )
     *                      },
     *                      allowMissingFields = false
     *                  )
     *              }
     *          }
     *     ),
     *     allowMissingFields = false
     * })
     */
    public $locations;
}