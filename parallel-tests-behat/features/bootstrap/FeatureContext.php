<?php

require "vendor/autoload.php";

use Behat\Behat\Context\BehatContext,
  Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class FeatureContext extends BehatContext {
  private $webDriver;
  private $BROWSER_NAME = 'firefox';
  private $OS = 'Windows';
  private $OS_VERSION = '7';
  private $BROWSER_VERSION = '23.0';
  private $USERNAME = ''; // Set your username
  private $BROWSERSTACK_KEY = ''; // Set your browserstack_key

  /** @Given /^I am on "([^"]*)"$/ */
  public function iAmOnSite($url) {
    $desiredCap =  array('browser'=> $this->BROWSER_NAME, 'browser_version'=> $this->BROWSER_VERSION, 'os' => $this->OS, 'os_version' => $this->OS_VERSION);
    $this->webDriver = RemoteWebDriver::create("http://".$this->USERNAME.":".$this->BROWSERSTACK_KEY."@hub.browserstack.com/wd/hub", $desiredCap);
    $this->webDriver->get($url);
  }

  /** @When /^I search for "([^"]*)"$/ */
  public function iSearchFor($searchText) {
    $element = $this->webDriver->findElement(WebDriverBy::name("q"));
    if ($element) {
      $element->sendKeys($searchText);
      $element->submit();
    }
  }

  /** @Then /^I get title as "([^"]*)"$/ */
  public function iShouldGet($string) {
    $title = $this->webDriver->getTitle();
    if ((string)  $string !== $title) {
      throw new Exception("Actual output is:\n". $title);
    }
    $this->webDriver->quit();
  }
}