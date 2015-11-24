@project
Feature: Project
  In order to have github repos monitored
  As a user
  I need to add project

  Background:
    Given I am logged in as "visitor1"

  @front
  Scenario: Creating new project
    Given I am adding new project
    When I fill "Project Name" with "devboard/test-hitman"
    And I save changes
    Then there should be project with "devboard/test-hitman" name in system
    And there should be github repo with "devboard/test-hitman" as full name in system
    And there should be github branch "master" for "devboard/test-hitman" in system
    And there should be github commit "db911bd3a3dd8bb2ad9eccbcb0a396595a51491d" for "devboard/test-hitman" in system
    And there should be github user with username "devboard-john"
