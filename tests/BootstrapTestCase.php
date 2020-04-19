<?php

namespace Photogabble\Portcullis\Tests;

class BootstrapTestCase extends \Orchestra\Testbench\TestCase
{

    /**
     * Informs Orchestra\Testbench that we we need these
     * Service Providers booting in order to test.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Laravel\Ui\UiServiceProvider',
            'Spatie\Activitylog\ActivitylogServiceProvider',
            'Photogabble\Portcullis\PortcullisServiceProvider'
        ];
    }

}