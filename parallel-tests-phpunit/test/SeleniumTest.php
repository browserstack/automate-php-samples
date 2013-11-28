<?php
require 'vendor/autoload.php';

class SeleniumTest extends PHPUnit_Framework_TestCase {

 protected static $user_id = "<Your Userid>";
 protected static $security_key = "<Your Security Key>";
 
 public function testGoogle() {
  $url = "http://" . self::$user_id . ":" . self::$security_key . "@hub.browserstack.com/wd/hub";
  $caps = array(
    "browser" => "IE",
    "browser_version" => "9.0",
    "os" => "Windows",
    "os_version" => "7",
    "browserstack.debug" => "true"    
  );
  $web_driver = RemoteWebDriver::create(
    $url,
    $caps
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
  $url = "http://" . self::$user_id . ":" . self::$security_key . "@hub.browserstack.com/wd/hub";
  $caps = array(
    "browser" => "IE",
    "browser_version" => "9.0",
    "os" => "Windows",
    "os_version" => "7",
    "browserstack.debug" => "true"    
  );
  $web_driver = RemoteWebDriver::create(
    $url,
    $caps
  );
  $web_driver->get("http://www.browserstack.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
 public function testFacebook() {
  $url = "http://" . self::$user_id . ":" . self::$security_key . "@hub.browserstack.com/wd/hub";
  $caps = array(
    "browser" => "IE",
    "browser_version" => "9.0",
    "os" => "Windows",
    "os_version" => "7",
    "browserstack.debug" => "true"    
  );
  $web_driver = RemoteWebDriver::create(
    $url,
    $caps
  );
  $web_driver->get("http://www.facebook.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
}
?> 
