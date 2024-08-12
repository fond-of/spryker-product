<?php

namespace FondOfSpryker\Zed\Product\Business\Product\Url;

use FondOfSpryker\Zed\Product\ProductConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\LocalizedUrlTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlGeneratorInterface;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface;

class ProductUrlGenerator implements ProductUrlGeneratorInterface
{
    /**
     * @var \Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface
     */
    protected ProductAbstractNameGeneratorInterface $productAbstractNameGenerator;

    /**
     * @var \Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface
     */
    protected ProductToLocaleInterface $localeFacade;

    /**
     * @var \Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface
     */
    protected ProductToUtilTextInterface $utilTextService;

    /**
     * @var \FondOfSpryker\Zed\Product\ProductConfig
     */
    protected ProductConfig $productConfig;

    /**
     * @param \Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface $productAbstractNameGenerator
     * @param \Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface $localeFacade
     * @param \Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface $utilTextService
     * @param \FondOfSpryker\Zed\Product\ProductConfig $productConfig
     */
    public function __construct(
        ProductAbstractNameGeneratorInterface $productAbstractNameGenerator,
        ProductToLocaleInterface $localeFacade,
        ProductToUtilTextInterface $utilTextService,
        ProductConfig $productConfig
    ) {
        $this->productAbstractNameGenerator = $productAbstractNameGenerator;
        $this->localeFacade = $localeFacade;
        $this->utilTextService = $utilTextService;
        $this->productConfig = $productConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function generateProductUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer
    {
        $availableLocales = $this->localeFacade->getLocaleCollection();

        $productUrlTransfer = new ProductUrlTransfer();
        $productUrlTransfer->setAbstractSku($productAbstractTransfer->getSku());

        foreach ($availableLocales as $localeTransfer) {
            $url = $this->generateUrlByLocale($productAbstractTransfer, $localeTransfer);

            $localizedUrl = new LocalizedUrlTransfer();
            $localizedUrl->setLocale($localeTransfer);
            $localizedUrl->setUrl($url);

            $productUrlTransfer->addUrl($localizedUrl);
        }

        return $productUrlTransfer;
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
        $urlLocaleToSkip = $this->productConfig->getUrlLocaleToSkip();
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
        $urlAttributeCode = $this->productConfig->getUrlAttributeCode();
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
