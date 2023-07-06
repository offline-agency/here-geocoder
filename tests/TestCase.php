<?php

namespace Thiagoprz\HereGeocoder\Test;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Thiagoprz\HereGeocoder\HereGeocoder;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Thiagoprz\HereGeocoder\HereGeocoderServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $hereGeocoder;

    public function setUp(): void
    {
        parent::setUp();
        $this->hereGeocoder = new HereGeocoder();
    }

    public function getPackageProviders(
        $app
    ): array {
        return [
            HereGeocoderServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
      //
    }

}
