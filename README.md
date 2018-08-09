# Extend Spryker Product Module
[![Build Status](https://travis-ci.org/fond-of/spryker-product.svg?branch=master)](https://travis-ci.org/fond-of/spryker-product)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/product)

Extend Spryker Product Module

* Use Custom Attribut to generate the Url 


## Installation

```
composer require fond-of-spryker/product
```

## 1. Add the Container ID in the configuration file 

```
// ---------- PRODUCT URL
$config[ProductUrlConstants::URL_ATTRIBUTE_CODE] = 'url_key';
```