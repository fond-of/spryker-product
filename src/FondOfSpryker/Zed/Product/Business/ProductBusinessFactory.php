<?php

namespace FondOfSpryker\Zed\Product\Business;

use FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlGenerator;
use FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlManager;
use FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlManagerInterface;
use FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlInterface;
use FondOfSpryker\Zed\Product\ProductDependencyProvider;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlGeneratorInterface;
use Spryker\Zed\Product\Business\ProductBusinessFactory as BaseProductBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Product\ProductConfig getConfig()
 * @method \Spryker\Zed\Product\Persistence\ProductEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\Product\Persistence\ProductQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Product\Persistence\ProductRepositoryInterface getRepository()
 */
class ProductBusinessFactory extends BaseProductBusinessFactory
{
    /**
     * @return \Spryker\Zed\Product\Business\Product\Url\ProductUrlGeneratorInterface
     */
    public function createProductUrlGenerator(): ProductUrlGeneratorInterface
    {
        return new ProductUrlGenerator(
            $this->createProductAbstractNameGenerator(),
            $this->getLocaleFacade(),
            $this->getUtilTextService(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlManagerInterface
     */
    public function createProductUrlManager(): ProductUrlManagerInterface
    {
        return new ProductUrlManager(
            $this->getUrlFacade(),
            $this->getTouchFacade(),
            $this->getLocaleFacade(),
            $this->getQueryContainer(),
            $this->createProductUrlGenerator(),
            $this->createProductEventTrigger(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlInterface
     */
    protected function getUrlFacade(): ProductToUrlInterface
    {
        return $this->getProvidedDependency(ProductDependencyProvider::FACADE_URL);
    }
}
