<?php

  require "php-webdriver/lib/__init__.php";

  $web_driver = RemoteWebDriver::create(
    "https://BS_USERNAME:BS_ACCESSKEY@hub.browserstack.com/wd/hub",
    array("platform"=>"WINDOWS", "browserName"=>"firefox")
  );
  $web_driver->get("http://google.com");

  $element = $web_driver->findElement(WebDriverBy::name("q"));
  if($element) {
      $element->sendKeys("Browserstack");
      $element->submit();
  }
  print $web_driver->getTitle();
  $web_driver->quit();
?>