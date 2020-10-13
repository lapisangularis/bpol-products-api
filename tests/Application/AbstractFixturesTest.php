<?php

declare(strict_types=1);

namespace App\Tests\Application;

use Fidry\AliceDataFixtures\LoaderInterface;
use Fidry\AliceDataFixtures\Persistence\PurgeMode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractFixturesTest extends WebTestCase
{
    protected const BASE_FIXTURES = [
        'tests/Resources/fixtures/product.php',
    ];

    protected $extraFixtures = [];

    /**
     * @var LoaderInterface
     */
    protected $loader;

    public function setUp(): void
    {
        self::bootKernel();
        $this->loader = self::$container->get('fidry_alice_data_fixtures.loader.doctrine');
        $this->loadFixtures();
    }

    public function setExtraFixtures(array $extraFixtures): void
    {
        $this->extraFixtures = $extraFixtures;
    }

    protected function loadFixtures(): void
    {
        $this->loader->load(array_merge(self::BASE_FIXTURES, $this->extraFixtures), [], [], PurgeMode::createTruncateMode());
    }
}
