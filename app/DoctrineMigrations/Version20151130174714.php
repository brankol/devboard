<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151130174714 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GithubCommitStatuses (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', state INT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, githubCommitId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', githubExternalServiceId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_18EB2E9F6FF5D9E2 (githubCommitId), INDEX IDX_18EB2E9FEE2444D7 (githubExternalServiceId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GithubCommitStatuses ADD CONSTRAINT FK_18EB2E9F6FF5D9E2 FOREIGN KEY (githubCommitId) REFERENCES GithubCommits (id)');
        $this->addSql('ALTER TABLE GithubCommitStatuses ADD CONSTRAINT FK_18EB2E9FEE2444D7 FOREIGN KEY (githubExternalServiceId) REFERENCES GithubExternalServices (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE GithubCommitStatuses');
    }
}
