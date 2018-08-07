<?php

/**
 * Extend Spryker Product Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\Product;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getContainerID()
    {
        return $this->get(GoogleTagManagerConstants::CONTAINER_ID);
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->get(GoogleTagManagerConstants::ENABLED);
    }
}
