<?php

declare(strict_types=1);

namespace mstrelan\TeamCityHtml;

use Drupal\Tests\Listeners\HtmlOutputPrinterTrait;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\TextUI\DefaultResultPrinter;
use PHPUnit\Util\Log\TeamCity;
use Throwable;

final class TeamCityHtmlPrinter extends DefaultResultPrinter {

  use HtmlOutputPrinterTrait;

  /**
   * @var \PHPUnit\Util\Log\TeamCity
   */
  private $teamCity;

  /**
   * {@inheritdoc}
   */
  public function __construct($out = NULL, bool $verbose = FALSE, string $colors = self::COLOR_DEFAULT, bool $debug = FALSE, $numberOfColumns = 80, bool $reverse = FALSE) {
    parent::__construct($out, $verbose, $colors, $debug, $numberOfColumns, $reverse);
    $this->teamCity = new TeamCity($out, $verbose, $colors, $debug, $numberOfColumns, $reverse);
    $this->setUpHtmlOutput();
  }

  /**
   * {@inheritdoc}
   */
  public function printResult(TestResult $result): void {
    $this->teamCity->printResult($result);
    $this->printHtmlOutput();
  }

  /**
   * {@inheritdoc}
   */
  public function addError(Test $test, Throwable $t, float $time): void {
    $this->teamCity->addError($test, $t, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function addWarning(Test $test, Warning $e, float $time): void {
    $this->teamCity->addWarning($test, $e, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function addFailure(Test $test, AssertionFailedError $e, float $time): void {
    $this->teamCity->addFailure($test, $e, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function addIncompleteTest(Test $test, Throwable $t, float $time): void {
    $this->teamCity->addIncompleteTest($test, $t, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function addRiskyTest(Test $test, Throwable $t, float $time): void {
    $this->teamCity->addRiskyTest($test, $t, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function addSkippedTest(Test $test, Throwable $t, float $time): void {
    $this->teamCity->addSkippedTest($test, $t, $time);
  }

  /**
   * {@inheritdoc}
   */
  public function startTestSuite(TestSuite $suite): void {
    $this->teamCity->startTestSuite($suite);
  }

  /**
   * {@inheritdoc}
   */
  public function endTestSuite(TestSuite $suite): void {
    $this->teamCity->endTestSuite($suite);
  }

  /**
   * {@inheritdoc}
   */
  public function startTest(Test $test): void {
    $this->teamCity->startTest($test);
  }

  /**
   * {@inheritdoc}
   */
  public function endTest(Test $test, float $time): void {
    $this->teamCity->endTest($test, $time);
  }

}
