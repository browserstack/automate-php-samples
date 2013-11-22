<?php

require "vendor/autoload.php";

use Behat\Behat\Context\BehatContext,
  Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class FeatureContext extends BehatContext {
  private $webDriver;
  private $BROWSER_NAME = 'firefox';
  private $PLATFORM = 'ANY';
  private $VERSION = '';
  private $USERNAME = ''; // Set your username
  private $BROWSERSTACK_KEY = ''; // Set your browserstack_key

  /** @Given /^I am on "([^"]*)"$/ */
  public function iAmOnSite($url) {
    $desiredCap =  array('browserName'=> $this->BROWSER_NAME, 'platform'=> $this->PLATFORM, 'version'=> $this->VERSION);
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