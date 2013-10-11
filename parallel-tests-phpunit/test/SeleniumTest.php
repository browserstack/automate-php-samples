<?php
require 'vendor/autoload.php';

class SeleniumTest extends PHPUnit_Framework_TestCase {
 public function testGoogle() {
  $web_driver = new RemoteWebDriver(
    "http://akshaybhardwaj1:XQWDewaJsUzqYJRv8zhr@hub.browserstack.com/wd/hub", 
    array("platform"=>"WINDOWS")
  );
  $web_driver->get("http://www.google.com");
  print $web_driver->getTitle();
  $element = $web_driver->findElement(WebDriverBy::name("q"));
  if ($element) {
    $element->sendKeys("Browserstack");
    $element->submit();
  }   
  $web_driver->quit();
 }
 public function testBrowserStack() {
  $web_driver = new RemoteWebDriver(
    "http://akshaybhardwaj1:XQWDewaJsUzqYJRv8zhr@hub.browserstack.com/wd/hub", 
    array("platform"=>"WINDOWS")
  );
  $web_driver->get("http://www.browserstack.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
 public function testFacebook() {
  $web_driver = new RemoteWebDriver(
    "http://akshaybhardwaj1:XQWDewaJsUzqYJRv8zhr@hub.browserstack.com/wd/hub", 
    array("platform"=>"WINDOWS")
  );
  $web_driver->get("http://www.facebook.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
}
?> 
