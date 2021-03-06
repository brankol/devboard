@githubBranch
Feature: Creating github branch
  In order to have github branch monitored
  As a user
  I need to add github branch data

  Background:
    Given I am logged in as "visitor1"
    And there is "devboard/test-hitman" github repo

  Scenario: Creating new github branch
    Given I am adding new github branch
    When I fill in details for "master" github branch for "devboard/test-hitman" github repo
    And I save changes
    Then there should be github branch "master" for "devboard/test-hitman" in system
