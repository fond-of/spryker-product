<?php

namespace FondOfSpryker\Zed\Product;

use FondOfSpryker\Shared\Product\ProductConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getUrlAttributeCode(): ?string
    {
        $urlAttributeCode = $this->get(ProductConstants::URL_ATTRIBUTE_CODE, '');

        if ($urlAttributeCode === '') {
            return null;
        }

        return $urlAttributeCode;
    }
}
