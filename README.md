# Extend Spryker Product Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/product)

Extend Spryker Product Module

* Use Custom Attribut to generate the Url


## Installation

```
composer require fond-of-spryker/product
```


## 1. To use the Custom Url generate functionality you have to take the following steps:

###Add the Attribute Code in the configuration file
```
// ---------- PRODUCT URL
$config[ProductConstants::URL_ATTRIBUTE_CODE] = 'url_key';
```

### Extend the Product Dependency in Pyz

```
protected function getProductAbstractBeforeCreatePlugins(Container $container)
{
    return [
        .......
        new UrlProductAbstractBeforeCreatePlugin()
    ];
}

```


```
protected function getProductAbstractAfterCreatePlugins(Container $container)
{
    return [
        ..........
        new UrlProductAbstractAfterCreatePlugin()
    ];
}
```

```
protected function getProductAbstractBeforeUpdatePlugins(Container $container)
{
    return [
        ..........
        new UrlProductAbstractBeforeUpdatePlugin()
    ];
}
```

```
protected function getProductAbstractAfterUpdatePlugins(Container $container)
{
    return [
        ..........
        new UrlProductAbstractAfterUpdatePlugin()
    ];
}
```
