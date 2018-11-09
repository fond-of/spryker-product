<?php

namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface as BaseProductFacadeInterface;

interface ProductFacadeInterface extends BaseProductFacadeInterface
{
    /**
     * Specification:
     * - Adds abstract product url.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function createProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer;

    /**
     * Specification:
     * - Updates abstract product url.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function updateProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer;

    /**
     * Specification:
     * - Checks if product url is already in use by another product.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    public function canPersistProductAbstractUrl(ProductAbstractTransfer $productAbstractTransfer): bool;
}
