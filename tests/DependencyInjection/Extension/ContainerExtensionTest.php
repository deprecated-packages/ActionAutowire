<?php

namespace Symplify\ActionAutowire\Tests\DependencyInjection\Extension;

use PHPUnit\Framework\TestCase;
use Symplify\ActionAutowire\DependencyInjection\Extension\ContainerExtension;
use Symplify\ActionAutowire\SymplifyMethodAutowireBundle;

final class ContainerExtensionTest extends TestCase
{
    public function testGetAlias()
    {
        $containerExtension = new ContainerExtension();
        $this->assertSame(SymplifyMethodAutowireBundle::ALIAS, $containerExtension->getAlias());
    }
}
