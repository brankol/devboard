@githubUser
Feature: Remote Github user data
  In order to have github repos monitored
  As a user
  I need to fetch remote github user data

  Background:
    Given I am logged in as "visitor1"

  Scenario: Fetching remote user data
    Given I am fetching remote user data from Github
    When I look for details on "msvrtan"
    Then I will get user details

  Scenario: Fetching non existing user data
    Given I am fetching remote user data from Github
    When I look for details on "AcmeDude542"
    Then I will get an error that user doesnt exist
