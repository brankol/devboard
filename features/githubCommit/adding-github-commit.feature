@githubCommit
Feature: Creating github commit
  In order to have github branches and PRs monitored
  As a user
  I need to add github commit as a part of creating/updating branch

  Background:
    Given I am logged in as "visitor1"
    And there is "AcmeDude542/BreakingBad" github repo
    And there is "devboard/test-hitman" github repo
    And there is "master" branch on "AcmeDude542/BreakingBad" github repo

  Scenario: Creating new github commit
    Given I am adding new github commit to "master" branch of "AcmeDude542/BreakingBad" repo
    When I fill in details for "Refactoring something" github commit
    And I save changes
    Then there should be github commit with message "Refactoring something" on "AcmeDude542/BreakingBad" repo in system

