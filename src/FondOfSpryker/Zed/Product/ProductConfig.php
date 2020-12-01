<?php

namespace FondOfSpryker\Zed\Product;

use FondOfSpryker\Shared\Product\ProductConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getUrlAttributeCode(): string
    {
        return $this->get(ProductConstants::URL_ATTRIBUTE_CODE, '');
    }

    /**
     * @return string
     */
    public function getUrlLocaleToSkip(): string
    {
        return $this->get(ProductConstants::URL_LOCALE_TO_SKIP, '');
    }
}
