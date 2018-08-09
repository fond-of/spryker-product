<?php

/**
 * FondOfSpryker Product Module Extends Spryker Product Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Product\Dependency\Facade\ProductToUrlInterface;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlGeneratorInterface;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlManager as SprykerProductUrlMananger;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface;
use Spryker\Zed\Product\Dependency\Facade\ProductToTouchInterface;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface;

class ProductUrlManager extends SprykerProductUrlMananger implements ProductUrlManagerInterface
{

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function createProductUrl(ProductAbstractTransfer $productAbstractTransfer)
    {
        parent::createProductUrl($productAbstractTransfer);

        return $productAbstractTransfer;
    }


    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function updateProductUrl(ProductAbstractTransfer $productAbstractTransfer)
    {
        parent::updateProductUrl($productAbstractTransfer);

        return $productAbstractTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @return bool
     */
    public function canPersistProductUrl(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        $productUrl = $this->urlGenerator->generateProductUrl($productAbstractTransfer);

        foreach ($productUrl->getUrls() as $urlTransfer) {
            $newUrlTransfer = new UrlTransfer();
            $newUrlTransfer->setUrl($urlTransfer->getUrl());

            $existingUrlTransfer = $this->urlFacade->findUrl($newUrlTransfer);

            if ($existingUrlTransfer === null) {
                continue;
            }

            if ($existingUrlTransfer->getFkResourceProductAbstract() === $productAbstractTransfer->getIdProductAbstract()) {
                continue;
            }

            return false;
        }

        return true;
    }
}
