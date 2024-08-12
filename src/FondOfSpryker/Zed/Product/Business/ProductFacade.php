<?php

namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use Spryker\Zed\Product\Business\ProductFacade as BaseProductFacade;

/**
 * @method \Spryker\Zed\Product\Business\ProductBusinessFactory getFactory()
 * @method \Spryker\Zed\Product\Persistence\ProductEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Product\Persistence\ProductRepositoryInterface getRepository()
 */
class ProductFacade extends BaseProductFacade implements ProductFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function createProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer
    {
        return $this->getFactory()
            ->createProductUrlManager()
            ->createProductUrl($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function updateProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer
    {
        return $this->getFactory()
            ->createProductUrlManager()
            ->updateProductUrl($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    public function canPersistProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        /** @var \FondOfSpryker\Zed\Product\Business\ProductUrlManagerInterface $productUrlManager */
        $productUrlManager = $this->getFactory()->createProductUrlManager();

        return $productUrlManager->canPersistProductUrl($productAbstractTransfer);
    }
}
