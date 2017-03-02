<?php
namespace App\Tests\Fixtures;

use Symfony\Component\HttpKernel\KernelInterface;
use TijmenWierenga\Bogus\Config\ConfigFile;
use TijmenWierenga\Bogus\Config\YamlConfig;
use TijmenWierenga\Bogus\Fixtures as BogusFixtures;
use TijmenWierenga\Bogus\Generator\MappingFile\MappingFileFactory;
use TijmenWierenga\Bogus\Storage\InMemoryStorageAdapter;
use TijmenWierenga\Bogus\Storage\Repository\Adapter\SymfonyContainerAwareRepositoryAdapter;

/**
 * Class Fixtures
 *
 * @author  Tijmen Wierenga <tijmen@devmob.com>
 */
trait Fixtures
{
    /**
     * @var BogusFixtures
     */
    protected static $fixtures;

    protected static function bootFixtures(): void
    {
        $config = new YamlConfig(new ConfigFile(__DIR__ . '/config.yml'));
        $factory = new MappingFileFactory($config);

        if (property_exists(self::class, 'kernel')) {
            /** @var KernelInterface $kernel */
            $kernel = self::$kernel;
            $storageAdapter = new SymfonyContainerAwareRepositoryAdapter($kernel->getContainer(), $config);
        } else {
            $storageAdapter = new InMemoryStorageAdapter();
        }

        self::$fixtures = new BogusFixtures($storageAdapter, $factory);
    }
}
