<?php

namespace FondOfSpryker\Zed\Product\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Product\Persistence\ProductQueryContainer as SprykerProductQueryContainer;

/**
 * @method \FondOfSpryker\Zed\Product\Persistence\ProductPersistenceFactory getFactory()
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

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductAbstract
     * @param int $idStore
     * @param int $idLocale
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery
     */
    public function queryUrlByIdProductAbstractidStoreAndIdLocale($idProductAbstract, $idStore, $idLocale): SpyUrlQuery
    {
        return $this->getFactory()
            ->getUrlQueryContainer()
            ->queryUrls()
            ->filterByFkResourceProductAbstract($idProductAbstract)
            ->filterByFkStore($idStore)
            ->filterByFkLocale($idLocale);
    }

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
    public function queryUrlByIdStoreAndIdLocaleAndUrl($idStore, $idLocale, $url): SpyUrlQuery
    {
        return $this->getFactory()
            ->getUrlQueryContainer()
            ->queryUrls()
            ->filterByFkStore($idStore)
            ->filterByUrl($url)
            ->filterByFkLocale($idLocale);
    }
}
