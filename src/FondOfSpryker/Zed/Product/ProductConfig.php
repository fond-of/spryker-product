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
        return $this->get(ProductConstants::URL_ATTRIBUTE_CODE, null);
    }

    /**
     * @return string|null
     */
    public function getUrlLocaleToSkip(): ?string
    {
        return $this->get(ProductConstants::URL_LOCALE_TO_SKIP, null);
    }
}
