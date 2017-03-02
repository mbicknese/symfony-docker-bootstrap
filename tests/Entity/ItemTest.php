<?php

namespace App\Tests\Entity;

use App\AppKernel;
use App\Entity\Item;
use App\Tests\BaseTestCase;
use App\Tests\Fixtures\Fixtures;

class ItemTest extends BaseTestCase
{
    use Fixtures;

    public function testPersist()
    {
        self::bootKernel();
        self::createSchema();
        $manager = static::$kernel->getContainer()->get('doctrine')->getManager();

        $item = Item::fromName('Test');
        $manager->persist($item);
        $manager->flush();

        $this->assertEquals(1, $item->getId());
        $this->assertSame('Test', $item->getName());
    }

    public function testFixtures()
    {
        self::bootKernel();
        self::createSchema();
        self::bootFixtures();

        /** @var Item $result */
        $result = self::$fixtures->create(Item::class, [
            'name' => 'Devmob'
        ])->first();

        $this->assertInstanceOf(Item::class, $result);
        $this->assertEquals('Devmob', $result->getName());
    }
}
