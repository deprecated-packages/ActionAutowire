<?php

namespace Symplify\ActionAutowire\Tests\HttpKernel\Controller;

use PHPUnit\Framework\TestCase;
use Symplify\ActionAutowire\Contract\HttpKernel\ControllerFinderInterface;
use Symplify\ActionAutowire\HttpKernel\Controller\ControllerFinder;
use Symplify\ActionAutowire\Tests\HttpKernel\Controller\ControllerFinderSource\SomeController;
use Symplify\ActionAutowire\Tests\HttpKernel\Controller\ControllerFinderSource\SomeOtherController;

final class ControllerFinderTest extends TestCase
{
    /**
     * @var ControllerFinderInterface
     */
    private $controllerFinder;

    protected function setUp()
    {
        $this->controllerFinder = new ControllerFinder();
    }

    public function testFindControllersInDirs()
    {
        $controllers = $this->controllerFinder->findControllersInDirs([__DIR__.'/ControllerFinderSource']);

        $this->assertEquals(
            [SomeController::class, SomeOtherController::class],
            $controllers,
            '',
            0.0,
            10,
            true
        );
    }
}
