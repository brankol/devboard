@githubRepo
Feature: Creating github repo
  In order to have github repos monitored
  As a user
  I need to add github repo as a part of creating project

  Background:
    Given I am logged in as "visitor1"

  Scenario: Creating new github repo
    Given I am adding new github repo
    When I fill in details for "AcmeDude542/BreakingBad" github repo
    And I save changes
    Then there should be github repo with "AcmeDude542/BreakingBad" as full name in system
