<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\ActionAutowire;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symplify\ActionAutowire\DependencyInjection\Compiler\RegisterControllersPass;
use Symplify\ActionAutowire\DependencyInjection\Compiler\ReplaceControllerResolverPass;
use Symplify\ActionAutowire\DependencyInjection\ControllerClassMap;
use Symplify\ActionAutowire\DependencyInjection\Extension\ContainerExtension;
use Symplify\ActionAutowire\HttpKernel\Controller\ControllerFinder;

final class SymplifyActionAutowireBundle extends Bundle
{
    /**
     * @var string
     */
    const ALIAS = 'symplify_action_autowire';

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $controllerClassMap = new ControllerClassMap();
        $controllerFinder = new ControllerFinder();

        $container->addCompilerPass(new RegisterControllersPass($controllerClassMap, $controllerFinder));
        $container->addCompilerPass(new ReplaceControllerResolverPass($controllerClassMap), PassConfig::TYPE_OPTIMIZE);
    }

    /**
     * {@inheritdoc}
     */
    public function createContainerExtension()
    {
        return new ContainerExtension();
    }
}
