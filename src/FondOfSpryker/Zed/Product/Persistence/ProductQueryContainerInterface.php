<?php

namespace FondOfSpryker\Zed\Product\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface as SprykerProductQueryContainerInterface;

interface ProductQueryContainerInterface extends SprykerProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery;

    /**
     * @api
     *
     * @param int $idProductAbstract
     * @param int $idStore
     * @param int $idLocale
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery
     */
    public function queryUrlByIdProductAbstractidStoreAndIdLocale($idProductAbstract, $idStore, $idLocale): SpyUrlQuery;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idStore
     * @param int $idLocale
     * @param string $url
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery
     */
    public function queryUrlByIdStoreAndIdLocaleAndUrl($idStore, $idLocale, $url): SpyUrlQuery;
}
