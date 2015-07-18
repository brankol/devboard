Feature: User login
  In order touse site
  As a user
  I need to login

  Scenario: Check that login is available from homepage
    Given I am on "/"
    And I click "Sign in"
    Then I should see "Remember me"
    And url is "/login"
