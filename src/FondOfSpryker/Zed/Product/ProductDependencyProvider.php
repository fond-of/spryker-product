<?php

namespace FondOfSpryker\Zed\Product;

use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToStoreBridge;
use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Product\ProductDependencyProvider as BaseProductDependencyProvider;

class ProductDependencyProvider extends BaseProductDependencyProvider
{
    public const FACADE_URL = 'PRODUCT:FACADE_URL';
    public const FACADE_STORE = 'PRODUCT:FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addUrlFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return new ProductToStoreBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
