@one
Feature: google
    Test the google website using selenium webdriver
  
    Scenario: Search for selenium on google search
      Given I am on "http://www.google.com"
      When I search for "selenium"
      Then I get title as "selenium - Google Search"
