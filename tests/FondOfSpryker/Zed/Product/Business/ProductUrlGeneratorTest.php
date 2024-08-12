<?php

namespace FondOfSpryker\Zed\Product\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlGenerator;
use FondOfSpryker\Zed\Product\ProductConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use ReflectionClass;
use Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGenerator;
use Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleBridge;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilTextBridge;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface;

class ProductUrlGeneratorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransfer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbtractNameGeneratorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilTextBridgeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeBridgeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(ProductConfig::class)
            ->onlyMethods(['getUrlLocaleToSkip', 'getUrlAttributeCode'])
            ->getMock();
        $this->configMock->method('getUrlAttributeCode')->willReturn('url_key');

        $this->productAbtractNameGeneratorMock = $this->getMockBuilder(ProductAbstractNameGenerator::class)
            ->onlyMethods(['getLocalizedProductAbstractName'])
            ->getMock();

        $this->productAbtractNameGeneratorMock->method('getLocalizedProductAbstractName')
            ->willReturn('ergobag cubo');

        $this->utilTextBridgeMock = $this->getMockBuilder(ProductToUtilTextBridge::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['generateSlug'])
            ->getMock();

        $this->utilTextBridgeMock->method('generateSlug')->willReturn('ergobag-cubo');

        $this->localeBridgeMock = $this->getMockBuilder(ProductToLocaleBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = new LocaleTransfer();
        $this->productAbstractTransfer = new ProductAbstractTransfer();
        $this->productAbstractTransfer->setIdProductAbstract('1');
    }

    /**
     * @return void
     */
    public function testGenerateUrlByLocale(): void
    {
        $mockUrlGenerator = $this->getProductUrlGeneratorMock('de');
        $productUrlGenerator = new ReflectionClass(ProductUrlGenerator::class);
        $generateUrlByLocale = $productUrlGenerator->getMethod('generateUrlByLocale');
        $generateUrlByLocale->setAccessible(true);

        $url = $generateUrlByLocale->invoke(
            $mockUrlGenerator,
            $this->productAbstractTransfer,
            $this->localeTransferMock,
        );

        $this->assertEquals('/de/ergobag-cubo-1', $url);
    }

    /**
     * @return void
     */
    public function testGenerateUrlSkipLocale(): void
    {
        $this->configMock->method('getUrlLocaleToSkip')->willReturn('de');

        $mockUrlGenerator = $this->getProductUrlGeneratorMock('de');
        $productUrlGenerator = new ReflectionClass(ProductUrlGenerator::class);
        $generateUrlByLocale = $productUrlGenerator->getMethod('generateUrlByLocale');
        $generateUrlByLocale->setAccessible(true);

        $url = $generateUrlByLocale->invoke(
            $mockUrlGenerator,
            $this->productAbstractTransfer,
            $this->localeTransferMock,
        );

        $this->assertEquals('/ergobag-cubo-1', $url);
    }

    /**
     * @return void
     */
    public function testGenerateUrlDontSkipLocale(): void
    {
        $this->configMock->method('getUrlLocaleToSkip')->willReturn('de');

        $mockUrlGenerator = $this->getProductUrlGeneratorMock('en');
        $productUrlGenerator = new ReflectionClass(ProductUrlGenerator::class);
        $generateUrlByLocale = $productUrlGenerator->getMethod('generateUrlByLocale');
        $generateUrlByLocale->setAccessible(true);

        $url = $generateUrlByLocale->invoke(
            $mockUrlGenerator,
            $this->productAbstractTransfer,
            $this->localeTransferMock,
        );

        $this->assertEquals('/en/ergobag-cubo-1', $url);
    }

    /**
     * @param string $locale
     *
     * @return \FondOfSpryker\Zed\Product\Business\Product\Url\ProductUrlGenerator
     */
    protected function getProductUrlGeneratorMock(string $locale): ProductUrlGenerator
    {
        return new class (
            $this->productAbtractNameGeneratorMock,
            $this->localeBridgeMock,
            $this->utilTextBridgeMock,
            $this->configMock,
            $locale
        ) extends ProductUrlGenerator {
            /**
             * @var string
             */
            public $mockLocale;

            /**
             * @param \Spryker\Zed\Product\Business\Product\NameGenerator\ProductAbstractNameGeneratorInterface $productAbstractNameGenerator
             * @param \Spryker\Zed\Product\Dependency\Facade\ProductToLocaleInterface $localeFacade
             * @param \Spryker\Zed\Product\Dependency\Service\ProductToUtilTextInterface $utilTextService
             * @param \FondOfSpryker\Zed\Product\ProductConfig $config
             * @param string $locale
             */
            public function __construct(
                ProductAbstractNameGeneratorInterface $productAbstractNameGenerator,
                ProductToLocaleInterface $localeFacade,
                ProductToUtilTextInterface $utilTextService,
                ProductConfig $config,
                string $locale
            ) {
                $this->mockLocale = $locale;

                parent::__construct(
                    $productAbstractNameGenerator,
                    $localeFacade,
                    $utilTextService,
                    $config,
                );
            }

            /**
             * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
             *
             * @return string
             */
            protected function getUrlPrefixByLocale(LocaleTransfer $localeTransfer): string
            {
                return $this->mockLocale;
            }
        };
    }
}
