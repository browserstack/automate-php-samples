# Documentation to write parallel tests in PHP

1. Install composer on your computer. Please follow instructions given on http://getcomposer.org/doc/00-intro.md. For this documentation composer.phar was renamed as composer and placed in /usr/local/bin(could be placed in any folder included in system path).
2. In your composer.json add enteries for paratest and webdriver. PHP Unit is included as dependency of paratest so will be also installed. This composer.json should be placed in project root and should look like:
```
{
  "require": {
      "brianium/paratest": "dev-master",
      "facebook/webdriver": "0.1"
  }
}
```
for php5.4+ please use dev-master version of facebook/webdriver and for php versions less then 5.3 please use facebook/webdriver version 0.1.
3. Install dependencies using composure. Please call bellow command in the project root containing composer.json
```
composer install
```
4. Or we can update dependencies using 
```
composer update
```
5. To use PHPUnit test please create phpunit.xml and place following code in it:
```
<?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false"
         syntaxCheck="false">
    
    <testsuites>
        <testsuite name="ParaTest Fixtures">
            <directory>./test/</directory>
        </testsuite>
    </testsuites>
</phpunit>
```
testsuites entry is used to integrate ParaTest with PHPUnit. In this tutorial tests are placed in test folder placed in the root folder of project.
6. Create test folder in project root if not present and then create SeleniumTest.php with following code in test folder
```
<?php
require 'vendor/autoload.php';
class SeleniumTest extends PHPUnit_Framework_TestCase {
 public function testGoogle() {
  $web_driver = new RemoteWebDriver(
    "http://{your-username}:{your-passkey}@hub.browserstack.com/wd/hub", 
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
    "http://{your-username}:{your-passkey}@hub.browserstack.com/wd/hub", 
    array("platform"=>"WINDOWS")
  );
  $web_driver->get("http://www.browserstack.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
 public function testFacebook() {
  $web_driver = new RemoteWebDriver(
    "http://{your-username}:{your-passkey}@hub.browserstack.com/wd/hub", 
    array("platform"=>"WINDOWS")
  );
  $web_driver->get("http://www.facebook.com");
  print $web_driver->getTitle();
  $web_driver->quit();
 }
}
?> 
```
7. To run this UnitTests in parallel please call following command:
```
vendor/bin/paratest -p 3 -f --phpunit=vendor/bin/phpunit test/SeleniumTest.php 
```