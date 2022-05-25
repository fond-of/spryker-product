<?php

namespace FondOfSpryker\Zed\Product;

use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToStoreBridge;
use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Product\ProductDependencyProvider as BaseProductDependencyProvider;

class ProductDependencyProvider extends BaseProductDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_URL = 'PRODUCT:FACADE_URL';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addUrlFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUrlFacade(Container $container): Container
    {
        $container[static::FACADE_URL] = function (Container $container) {
            return new ProductToUrlBridge($container->getLocator()->url()->facade());
        };

        return $container;
    }
}
