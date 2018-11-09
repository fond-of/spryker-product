<?php

/**
 * FondOfSpryker Product Module Extends Spryker Product Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use Spryker\Zed\Product\Business\ProductFacade as BaseProductFacade;

/**
 * @method \FondOfSpryker\Zed\Product\Business\ProductBusinessFactory getFactory()
 */
class ProductFacade extends BaseProductFacade implements ProductFacadeInterface
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    public function canPersistProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        return $this->getFactory()->createProductUrlManager()->canPersistProductUrl($productAbstractTransfer);
    }
}
