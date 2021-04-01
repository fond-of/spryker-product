<?php

namespace FondOfSpryker\Zed\Product;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\Product\ProductConstants;

class ProductConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Product\ProductConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productConfig = $this->getMockBuilder(ProductConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetUrlAttributeCode()
    {
        $this->productConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductConstants::URL_ATTRIBUTE_CODE, '')
            ->willReturn('url_key');

        static::assertEquals('url_key', $this->productConfig->getUrlAttributeCode());
    }

    /**
     * @return void
     */
    public function testGetDefaultUrlAttributeCode()
    {
        $this->productConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductConstants::URL_ATTRIBUTE_CODE, '')
            ->willReturn('');

        static::assertEquals(null, $this->productConfig->getUrlAttributeCode());
    }
}
