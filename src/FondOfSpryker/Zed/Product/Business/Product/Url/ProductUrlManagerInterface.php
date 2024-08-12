<?php

namespace FondOfSpryker\Zed\Product\Business\Product\Url;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlManagerInterface as SprykerProductUrlManangerInterface;

interface ProductUrlManagerInterface extends SprykerProductUrlManangerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    public function canPersistProductUrl(ProductAbstractTransfer $productAbstractTransfer): bool;
}
