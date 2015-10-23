@user
Feature: User registration
  In order to increase security
  As a user
  I need to disallow any kind of user registering on site

  Scenario: Check that registration redirects to home page
    Given I am on "/register"
    Then I should be on homepage