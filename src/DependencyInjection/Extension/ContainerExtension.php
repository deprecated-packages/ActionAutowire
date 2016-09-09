<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\ActionAutowire\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symplify\ActionAutowire\SymplifyMethodAutowireBundle;

final class ContainerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function getAlias() : string
    {
        return SymplifyMethodAutowireBundle::ALIAS;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $containerBuilder)
    {
    }
}
