<?php

/**
 * FondOfSpryker Product Module Extends Spryker Product Moduel
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
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
        return $this->get(ProductConstants::URL_ATTRIBUTE_CODE);
    }
}
