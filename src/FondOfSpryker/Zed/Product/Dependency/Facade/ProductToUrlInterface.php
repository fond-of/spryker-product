<?php

namespace FondOfSpryker\Zed\Product\Dependency\Facade;

use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Product\Dependency\Facade\ProductToUrlInterface as SprykerProductToUrlInterface;

interface ProductToUrlInterface extends SprykerProductToUrlInterface
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return mixed
     */
    public function findUrl(UrlTransfer $urlTransfer);
}