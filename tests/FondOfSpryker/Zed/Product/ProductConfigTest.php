<?php

namespace FondOfSpryker\Zed\Product;

use Codeception\Test\Unit;

class ProductConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Product\ProductConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    private $configMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        $this->configMock = $this->getMockBuilder(ProductConfig::class)
            ->onlyMethods(['getUrlAttributeCode', 'getUrlLocaleToSkip'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetUrlAttributeCode(): void
    {
        $this->configMock->method('getUrlAttributeCode')->willReturn('url_key');
        $this->assertEquals('url_key', $this->configMock->getUrlAttributeCode());
    }

    /**
     * @return void
     */
    public function testGetUrlLocaleToSkip(): void
    {
        $this->configMock->method('getUrlLocaleToSkip')->willReturn('de');
        $this->assertEquals('de', $this->configMock->getUrlLocaleToSkip());
    }
}
