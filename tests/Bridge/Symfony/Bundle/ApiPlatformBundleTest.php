<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Tests\Bridge\Symfony\Bundle;

use ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\AnnotationFilterPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\AuthenticatorManagerPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\DataProviderPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\DeprecateMercurePublisherPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\ElasticsearchClientPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\FilterPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\GraphQlMutationResolverPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\GraphQlQueryResolverPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\GraphQlTypePass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\MetadataAwareNameConverterPass;
use ApiPlatform\Core\Bridge\Symfony\Bundle\DependencyInjection\Compiler\TestClientPass;
use ApiPlatform\Core\Tests\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class ApiPlatformBundleTest extends TestCase
{
    use ProphecyTrait;

    public function testBuild()
    {
        $containerProphecy = $this->prophesize(ContainerBuilder::class);
        $containerProphecy->addCompilerPass(Argument::type(DataProviderPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(AnnotationFilterPass::class), PassConfig::TYPE_BEFORE_OPTIMIZATION, 101)->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(FilterPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(ElasticsearchClientPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(GraphQlTypePass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(GraphQlQueryResolverPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(GraphQlMutationResolverPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(DeprecateMercurePublisherPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(MetadataAwareNameConverterPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(TestClientPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();
        $containerProphecy->addCompilerPass(Argument::type(AuthenticatorManagerPass::class))->willReturn($containerProphecy->reveal())->shouldBeCalled();

        $bundle = new ApiPlatformBundle();
        $bundle->build($containerProphecy->reveal());
    }
}
