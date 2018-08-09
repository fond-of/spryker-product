<?php

/**
 * FondOfSpryker Product Module Extends Spryker Product Moduel
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product\Business;

use FondOfSpryker\Zed\Product\ProductConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlGenerator as SprykerProductUrlGenerator;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface;

/**
 * Implement your project specific url generation logic
 */
class ProductUrlGenerator extends SprykerProductUrlGenerator
{
    /**
     * @var \FondOfSpryker\Zed\Product\ProductConfig
     */
    protected $config;

    /**
     * ProductUrlGenerator constructor.
     *
     * @param \Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface $productAbstractNameGenerator
     * @param \Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface $localeFacade
     * @param \Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface $utilTextService
     * @param \FondOfSpryker\Zed\Product\ProductConfig $config
     */
    public function __construct(
        ProductAbstractNameGeneratorInterface $productAbstractNameGenerator,
        ProductToLocaleInterface $localeFacade,
        ProductToUtilTextInterface $utilTextService,
        ProductConfig $config
    ) {

        parent::__construct($productAbstractNameGenerator, $localeFacade, $utilTextService);

        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return string
     */
    protected function generateUrlByLocale(ProductAbstractTransfer $productAbstractTransfer, LocaleTransfer $localeTransfer): string
    {
        if ($urlAttributeCode = $this->config->getUrlAttributeCode()) {
            $localizedAttributes = $productAbstractTransfer->getLocalizedAttributes();

            foreach ($localizedAttributes as $localizedAttribute) {
                if ($localizedAttribute->getLocale()->getIdLocale() !== $localeTransfer->getIdLocale()) {
                    continue;
                }

                $attributes = $localizedAttribute->getAttributes();

                if (!array_key_exists($urlAttributeCode, $attributes) || !isset($attributes[$urlAttributeCode])) {
                    return false;
                }

                return '/' . mb_substr($localeTransfer->getLocaleName(), 0, 2) . '/' . $attributes[$urlAttributeCode];
            }
        }

        return parent::generateUrlByLocale($productAbstractTransfer, $localeTransfer);
    }
}
