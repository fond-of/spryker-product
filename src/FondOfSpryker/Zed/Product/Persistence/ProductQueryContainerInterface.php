<?php

namespace FondOfSpryker\Zed\Product\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface as SprykerProductQueryContainerInterface;

interface ProductQueryContainerInterface extends SprykerProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery;
}
