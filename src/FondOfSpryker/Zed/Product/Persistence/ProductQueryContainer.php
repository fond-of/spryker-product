<?php

namespace FondOfSpryker\Zed\Product\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\Product\Persistence\ProductQueryContainer as SprykerProductQueryContainer;

/**
 * @method \Spryker\Zed\Product\Persistence\ProductPersistenceFactory getFactory()
 */
class ProductQueryContainer extends SprykerProductQueryContainer implements ProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery
    {
        return $this->getFactory()->createProductAbstractStoreQuery();
    }
}
