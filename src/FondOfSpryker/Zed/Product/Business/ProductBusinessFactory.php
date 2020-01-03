<?php

namespace FondOfSpryker\Zed\Product\Business;

use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlInterface;
use FondOfSpryker\Zed\Product\ProductDependencyProvider;
use Spryker\Zed\Product\Business\Product\ProductAbstractManager;
use Spryker\Zed\Product\Business\ProductBusinessFactory as BaseProductBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Product\ProductConfig getConfig()
 */
class ProductBusinessFactory extends BaseProductBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\Product\Business\ProductUrlGenerator
     */
    public function createProductUrlGenerator()
    {
        return new ProductUrlGenerator(
            $this->createProductAbstractNameGenerator(),
            $this->getLocaleFacade(),
            $this->getUtilTextService(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Product\Business\ProductUrlManagerInterface
     */
    public function createProductUrlManager(): ProductUrlManagerInterface
    {
        return new ProductUrlManager(
            $this->getUrlFacade(),
            $this->getTouchFacade(),
            $this->getLocaleFacade(),
            $this->getQueryContainer(),
            $this->createProductUrlGenerator()
        );
    }

    /**
     * @param \Spryker\Zed\Product\Business\Product\ProductAbstractManager $productAbstractManager
     *
     * @return \Spryker\Zed\Product\Business\Product\ProductAbstractManager
     */
    protected function attachProductAbstractManagerObservers(ProductAbstractManager $productAbstractManager)
    {
        $productAbstractManager->attachBeforeCreateObserver($this->createProductAbstractBeforeCreateObserverPluginManager());
        $productAbstractManager->attachAfterCreateObserver($this->createProductAbstractAfterCreateObserverPluginManager());
        $productAbstractManager->attachBeforeUpdateObserver($this->createProductAbstractBeforeUpdateObserverPluginManager());
        $productAbstractManager->attachAfterUpdateObserver($this->createProductAbstractAfterUpdateObserverPluginManager());
        $productAbstractManager->attachReadObserver($this->createProductAbstractReadObserverPluginManager());

        return $productAbstractManager;
    }

    /**
     * @return \FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlInterface
     */
    protected function getUrlFacade(): ProductToUrlInterface
    {
        return $this->getProvidedDependency(ProductDependencyProvider::FACADE_URL);
    }
}
