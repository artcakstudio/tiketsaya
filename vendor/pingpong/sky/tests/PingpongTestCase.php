<?php

abstract class PingpongTestCase extends \Pingpong\Testing\TestCase {

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @return string
     */
    public function getBasePath()
    {
        return realpath(__DIR__ . '/../vendor/pingpong/testing/fixture');
    }

    protected function getPackageProviders()
    {
        return [
            'Pingpong\Trusty\TrustyServiceProvider',
            'Pingpong\Menus\MenusServiceProvider',
            'Pingpong\Widget\WidgetServiceProvider',
            'Pingpong\Themes\ThemesServiceProvider',
            'Pingpong\Shortcode\ShortcodeServiceProvider',
            'Pingpong\Generators\GeneratorsServiceProvider',
            'Pingpong\Modules\ModulesServiceProvider',
        ];
    }

    protected function getPackageAliases()
    {
        return [];
    }


}