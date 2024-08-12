<?php

namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlManager as SprykerProductUrlMananger;

class ProductUrlManager extends SprykerProductUrlMananger implements ProductUrlManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    public function canPersistProductUrl(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        /** @var \FondOfSpryker\Zed\Product\Dependency\Facade\ProductToUrlBridge $urlFacade */
        $urlFacade = $this->urlFacade;

        $productUrl = $this->urlGenerator->generateProductUrl($productAbstractTransfer);

        foreach ($productUrl->getUrls() as $urlTransfer) {
            $newUrlTransfer = new UrlTransfer();
            $newUrlTransfer->setUrl($urlTransfer->getUrl());

            $existingUrlTransfer = $urlFacade->findUrl($newUrlTransfer);

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
