<?php

namespace Symplify\ActionAutowire\Tests\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symplify\ActionAutowire\DependencyInjection\Compiler\RegisterControllersPass;
use Symplify\ActionAutowire\DependencyInjection\ControllerClassMap;
use Symplify\ActionAutowire\HttpKernel\Controller\ControllerFinder;
use Symplify\ActionAutowire\SymplifyMethodAutowireBundle;
use Symplify\ActionAutowire\Tests\DependencyInjection\Compiler\RegisterControllersPassSource\SomeController;

final class RegisterControllersPassTest extends TestCase
{
    /**
     * @var RegisterControllersPass
     */
    private $registerControllersPass;

    protected function setUp()
    {
        $controllerClassMap = new ControllerClassMap();
        $controllerClassMap->addController('somecontroller', 'SomeController');

        $controllerFinder = new ControllerFinder();
        $this->registerControllersPass = new RegisterControllersPass($controllerClassMap, $controllerFinder);
    }

    public function testProcess()
    {
        $containerBuilder = new ContainerBuilder();
        $this->assertCount(0, $containerBuilder->getDefinitions());

        $containerBuilder->prependExtensionConfig(SymplifyMethodAutowireBundle::ALIAS, [
            'controller_dirs' => [
                __DIR__.'/RegisterControllersPassSource',
            ],
        ]);
        $this->registerControllersPass->process($containerBuilder);

        $definitions = $containerBuilder->getDefinitions();
        $this->assertCount(1, $definitions);

        /** @var Definition $controllerDefinition */
        $controllerDefinition = array_pop($definitions);
        $this->assertInstanceOf(Definition::class, $controllerDefinition);

        $this->assertSame(SomeController::class, $controllerDefinition->getClass());
        $this->assertTrue($controllerDefinition->isAutowired());
    }

    public function testServiceDefinitionExists()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->prependExtensionConfig(SymplifyMethodAutowireBundle::ALIAS, [
            'controller_dirs' => [
                __DIR__.'/RegisterControllersPassSource',
            ],
        ]);

        $controllerDefition = new Definition(SomeController::class);
        $containerBuilder->setDefinition(
            'symplify.ActionAutowire.tests.dependencyinjection.'
                .'compiler.registercontrollerspasssource.somecontroller',
            $controllerDefition
        );
        $this->assertCount(1, $containerBuilder->getDefinitions());

        $this->registerControllersPass->process($containerBuilder);
        $this->assertCount(1, $containerBuilder->getDefinitions());

        $this->assertTrue($controllerDefition->isAutowired());
    }
}
