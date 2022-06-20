# TeamCity HTML Printer

Provides support for Drupal HTML output printer to phpunit's teamcity result printer. 

## Overview

Running phpunit tests in PHPStorm requires the TeamCity listener. To enforce this it passes the `--teamcity` argument to
phpunit which overrides any other printer class provided via phpunit.xml or via the `--printer` argument. Unfortunately
this means Drupal's HTML output printer is not activated and the HTML output URLs are not displayed.

This package intercepts phpunit runs and modifies the arguments to allow for a custom printer. This approach was
inspired by [symfony/phpunit-bridge](https://github.com/symfony/phpunit-bridge). The custom printer decorates the
TeamCity result printer class with HTML output from Drupal's HtmlOutputPrinterTrait.

## Installation

```shell
composer require --dev mstrelan/teamcity-html
```
