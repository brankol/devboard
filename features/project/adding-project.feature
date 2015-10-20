@project
Feature: Project
  In order to have github repos monitored
  As a user
  I need to add project

  Background:
    Given I am logged in as "visitor1"

  Scenario: Creating new project
    Given I am adding new project
    When I fill "Project Name" with "owner/repository"
    And I save changes
    Then there should be project with "owner/repository" name in system
