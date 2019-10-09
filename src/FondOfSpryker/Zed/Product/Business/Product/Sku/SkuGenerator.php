<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\Product\Business\Product\Sku;

use Spryker\Zed\Product\Business\Product\Sku\SkuGenerator as SprykerSkuGenerator;

class SkuGenerator extends SprykerSkuGenerator
{
    /**
     *  - Transliterates from UTF-8 to ASCII character set
     *  - Removes all non Alphanumeric and (.,-,_) characters, keeps whitespace
     *  - Replaces multiple dashes with single dash
     *
     * @param string $sku
     *
     * @return string
     */
    protected function sanitizeSku($sku)
    {
        if (function_exists('iconv')) {
            $sku = iconv('UTF-8', 'ASCII//TRANSLIT', $sku);
        }

        $sku = preg_replace("/[^a-zA-Z0-9\.\-\_\s]/", '', trim($sku));
        $sku = preg_replace('/(\-)\1+/', '$1', $sku);

        return $sku;
    }
}
