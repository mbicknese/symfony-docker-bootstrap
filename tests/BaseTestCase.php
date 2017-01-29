<?php

namespace App\Tests;

use App\AppKernel;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseTestCase extends WebTestCase
{
    protected static $class = AppKernel::class;

    /**
     * Boots the Kernel for this test.
     *
     * @param array $options
     */
    protected static function bootKernel(array $options = array())
    {
        parent::bootKernel($options);

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $schemaTool = new SchemaTool($em);
        $metadata = $em->getMetadataFactory()->getAllMetadata();
        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata, true);
    }
}
