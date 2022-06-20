<?php

// Detect if we're loaded by an actual run of phpunit
if (!defined('PHPUNIT_COMPOSER_INSTALL') && !class_exists(\PHPUnit\TextUI\Command::class, false)) {
  return;
}

// Detect if the --teamcity argument was provided.
if (!isset($_SERVER['argv']) || !is_array($_SERVER['argv']) || !in_array('--teamcity', $_SERVER['argv'])) {
  return;
}

// Replace the --teamcity argument with the TeamCityHtmlPrinter.
$_SERVER['argv'] = array_diff($_SERVER['argv'], ['--teamcity']);
array_push($_SERVER['argv'], '--printer', \mstrelan\TeamCityHtml\TeamCityHtmlPrinter::class);
