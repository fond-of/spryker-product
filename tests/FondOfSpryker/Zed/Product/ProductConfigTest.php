<?php

namespace FondOfSpryker\Zed\Product;

use Codeception\Test\Unit;
use org\bovigo\vfs\vfsStream;

class ProductConfigTest extends Unit
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsStreamDirectory;

    /**
     * @return void
     */
    public function _before()
    {
        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('config_default.php')),
                ],
            ],
        ]);
    }

    /**
     * @return void
     */
    public function testGetUrlAttributeCode()
    {
        $productConfig = new ProductConfig();

        $this->assertEquals('url_key', $productConfig->getUrlAttributeCode());
    }

}
