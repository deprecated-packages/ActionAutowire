<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\ActionAutowire\DependencyInjection;

use Symplify\ActionAutowire\Contract\DependencyInjection\ControllerClassMapInterface;

final class ControllerClassMap implements ControllerClassMapInterface
{
    /**
     * @var string[]
     */
    private $controllers = [];

    /**
     * {@inheritdoc}
     */
    public function addController(string $id, string $class)
    {
        $this->controllers[$id] = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function getControllers() : array
    {
        return $this->controllers;
    }
}
