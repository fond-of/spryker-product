<?php

namespace FondOfSpryker\Zed\Product\Business;

use FondOfSpryker\Zed\Product\ProductConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Shared\Kernel\Store;
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
    protected function generateUrlByLocale(
        ProductAbstractTransfer $productAbstractTransfer,
        LocaleTransfer $localeTransfer
    ): string {
        $urlLocaleToSkip = $this->config->getUrlLocaleToSkip();
        $urlPrefix = $this->getUrlPrefixByLocale($localeTransfer);
        $urlKey = $this->getUrlKey($productAbstractTransfer, $localeTransfer);

        if ($urlLocaleToSkip !== '' && $urlPrefix === $urlLocaleToSkip) {
            return sprintf('/%s', $urlKey);
        }

        return sprintf('/%s/%s', $urlPrefix, $urlKey);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return string
     */
    protected function getUrlKey(
        ProductAbstractTransfer $productAbstractTransfer,
        LocaleTransfer $localeTransfer
    ): string {
        $urlAttributeCode = $this->config->getUrlAttributeCode();
        $localizedProductName = $this->productAbstractNameGenerator->getLocalizedProductAbstractName($productAbstractTransfer, $localeTransfer);
        $slug = $this->utilTextService->generateSlug($localizedProductName);

        $urlKey = $slug . '-' . $productAbstractTransfer->getIdProductAbstract();

        if ($urlAttributeCode === '') {
            return $urlKey;
        }

        $localizedAttributes = $productAbstractTransfer->getLocalizedAttributes();

        foreach ($localizedAttributes as $localizedAttribute) {
            if ($localizedAttribute->getLocale()->getIdLocale() !== $localeTransfer->getIdLocale()) {
                continue;
            }

            $attributes = $localizedAttribute->getAttributes();

            if (!array_key_exists($urlAttributeCode, $attributes) || empty($attributes[$urlAttributeCode])) {
                break;
            }

            return $attributes[$urlAttributeCode];
        }

        return $urlKey;
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return string
     */
    protected function getUrlPrefixByLocale(LocaleTransfer $localeTransfer): string
    {
        $locales = Store::getInstance()->getLocales();

        foreach ($locales as $urlPrefix => $locale) {
            if ($locale !== $localeTransfer->getLocaleName()) {
                continue;
            }

            return $urlPrefix;
        }

        return mb_substr($localeTransfer->getLocaleName(), 0, 2);
    }
}
