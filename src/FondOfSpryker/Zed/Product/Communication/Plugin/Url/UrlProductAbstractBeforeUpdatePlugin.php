<?php

namespace FondOfSpryker\Zed\Product\Communication\Plugin\Url;

use FondOfSpryker\Zed\Product\Business\Exception\DuplicateUrlKeyException;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface;

/**
 * @method \Spryker\Zed\Product\Business\ProductFacadeInterface getFacade()
 * @method \Spryker\Zed\Product\ProductConfig getConfig()
 * @method \Spryker\Zed\Product\Persistence\ProductQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Product\Communication\ProductCommunicationFactory getFactory()
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
        /** @var \FondOfSpryker\Zed\Product\Business\ProductFacadeInterface $facade */
        $facade = $this->getFacade();

        if (!$facade->canPersistProductAbstractUrl($productAbstractTransfer)) {
            throw new DuplicateUrlKeyException('Url key already exists!');
        }

        return $productAbstractTransfer;
    }
}
