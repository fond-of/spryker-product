<?php

namespace FondOfSpryker\Zed\Product;

use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Product\ProductDependencyProvider as BaseProductDependencyProvider;

class ProductDependencyProvider extends BaseProductDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container[self::FACADE_URL] = function (Container $container) {
            return new ProductToUrlBridge($container->getLocator()->url()->facade());
        };

        return $container;
    }
}
