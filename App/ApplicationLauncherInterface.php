<?php


namespace App;

use App\Router\RouterInterface;

/**
 * Interface ApplicationLauncherInterface
 * @package App
 */
interface ApplicationLauncherInterface
{

    /**
     * @return void
     */
    public function bootstrap();

    /**
     * @return RouterInterface
     */
    public function createRouter();

    /**
     * @return void
     */
    public function launch();

}