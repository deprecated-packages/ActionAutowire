<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\ActionAutowire\HttpKernel\Controller;

use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Yields autowired service as argument's value.
 *
 * @author Jáchym Toušek <enumag@gmail.com>
 */
final class AutowiringValueResolver implements ArgumentValueResolverInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $classMap;

    public function __construct(ContainerInterface $container, array $classMap)
    {
        $this->container = $container;
        $this->classMap = $classMap;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return !$argument->isVariadic() && isset($this->classMap[$argument->getType()]);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $this->container->get($this->classMap[$argument->getType()]);
    }
}
