<?php

/**
 * Spryker Product Url Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product\Communication\Plugin\Url;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface;

/**
* @method \FondOfSpryker\Zed\Product\Business\ProductFacadInterface getFacade()
*/
class UrlProductAbstractBeforeUpdatePlugin extends AbstractPlugin implements ProductAbstractPluginUpdateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function update(ProductAbstractTransfer $productAbstractTransfer)
    {
        if (!$this->getFacade()->canPersistProductUrl($productAbstractTransfer)) {
            throw new \Exception('Url key already exists!');
        }

        return $productAbstractTransfer;
    }
}
