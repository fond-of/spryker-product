<?php

namespace FondOfSpryker\Zed\Product\Communication\Plugin\Url;

use FondOfSpryker\Zed\Product\Business\Exception\DuplicateUrlKeyException;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface;

/**
 * @method \FondOfSpryker\Zed\Product\Business\ProductFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\Product\ProductConfig getConfig()
 */
class UrlProductAbstractBeforeUpdatePlugin extends AbstractPlugin implements ProductAbstractPluginUpdateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @throws \FondOfSpryker\Zed\Product\Business\Exception\DuplicateUrlKeyException
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function update(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        if (!$this->getFacade()->canPersistProductAbstractUrl($productAbstractTransfer)) {
            throw new DuplicateUrlKeyException('Url key already exists!');
        }

        return $productAbstractTransfer;
    }
}
