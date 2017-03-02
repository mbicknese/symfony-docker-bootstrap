<?php
namespace App\Tests\Fixtures\Mapping;

use App\Entity\Item;
use Faker\Factory;
use TijmenWierenga\Bogus\Generator\MappingFile\AbstractMapper;
use TijmenWierenga\Bogus\Generator\MappingFile\Mappable;

/**
 * @author Tijmen Wierenga <tijmen.wierenga@devmob.com>
 */
class ItemMapper extends AbstractMapper implements Mappable
{
    /**
     * @return array  An array of random attributes used to create a new fixture
     */
    public static function attributes(): array
    {
        return [
            'name' => (Factory::create())->firstName
        ];
    }

    /**
     * @param  array $attributes  An array with the random attributes combined with the overridden attributes
     * @return object             The constructed entity based on the provided attributes
     */
    public static function create(array $attributes)
    {
        return Item::fromName($attributes['name']);
    }

}
