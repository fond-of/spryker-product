<?php

/**
 * Extend Spryker Product Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product\Business\Product\Url;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface;
use Spryker\Zed\Product\Business\Product\Url\ProductUrlGenerator as SprykerProductUrlGenerator;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface;
use Spryker\Zed\Product\Dependency\Facade\ProductToUrlInterface;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface;

/**
 * Implement your project specific url generation logic
 */
class ProductUrlGenerator extends SprykerProductUrlGenerator
{
    /**
     * @var \Spryker\Zed\Product\Dependency\Facade\ProductToUrlInterface
     */
    protected $urlFacade;

    /**
     * @param \Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface $productAbstractNameGenerator
     * @param \Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface $localeFacade
     * @param \Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface $utilTextService
     * @param \Spryker\Zed\Product\Dependency\Facade\ProductToUrlInterface $urlFacade
     */
    public function __construct(
        ProductAbstractNameGeneratorInterface $productAbstractNameGenerator,
        ProductToLocaleInterface $localeFacade,
        ProductToUtilTextInterface $utilTextService,
        ProductToUrlInterface $urlFacade
    ) {
        parent::__construct(
            $productAbstractNameGenerator,
            $localeFacade,
            $utilTextService,
            $urlFacade
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return string
     */
    protected function generateUrlByLocale(ProductAbstractTransfer $productAbstractTransfer, LocaleTransfer $localeTransfer)
    {
        $localizedAttributes = $productAbstractTransfer->getLocalizedAttributes();

        foreach ($localizedAttributes as $localizedAttribute) {
            if ($localizedAttribute->getLocale()->getIdLocale() !== $localeTransfer->getIdLocale()) {
                continue;
            }

            $attributes = $localizedAttribute->getAttributes();

            if (!array_key_exists('url_key', $attributes) || !isset($attributes['url_key'])) {
                return false;
            }

            return '/' . mb_substr($localeTransfer->getLocaleName(), 0, 2) . '/' . $attributes['url_key'];
        }

        return '';
    }
}
