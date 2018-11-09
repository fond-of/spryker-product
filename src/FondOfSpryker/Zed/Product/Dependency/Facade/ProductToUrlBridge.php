<?php

namespace FondOfSpryker\Zed\Product\Dependency\Facade;

use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Product\Dependency\Facade\ProductToUrlBridge as BaseProductToUrlBridge;

class ProductToUrlBridge extends BaseProductToUrlBridge implements ProductToUrlInterface
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer|null
     */
    public function findUrl(UrlTransfer $urlTransfer): ?UrlTransfer
    {
        return $this->urlFacade->findUrl($urlTransfer);
    }
}
