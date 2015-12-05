<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151205212238 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GithubTags (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, repoId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', lastCommitId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_A9B882E3E52A88D8 (repoId), INDEX IDX_A9B882E36707D2E (lastCommitId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GithubTags ADD CONSTRAINT FK_A9B882E3E52A88D8 FOREIGN KEY (repoId) REFERENCES GithubRepos (id)');
        $this->addSql('ALTER TABLE GithubTags ADD CONSTRAINT FK_A9B882E36707D2E FOREIGN KEY (lastCommitId) REFERENCES GithubCommits (id)');
        $this->addSql('DROP TABLE GithubTages');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GithubTages (id CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, repoId CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', lastCommitId CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', INDEX IDX_3E3C719CE52A88D8 (repoId), INDEX IDX_3E3C719C6707D2E (lastCommitId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GithubTages ADD CONSTRAINT FK_3E3C719C6707D2E FOREIGN KEY (lastCommitId) REFERENCES GithubCommits (id)');
        $this->addSql('ALTER TABLE GithubTages ADD CONSTRAINT FK_3E3C719CE52A88D8 FOREIGN KEY (repoId) REFERENCES GithubRepos (id)');
        $this->addSql('DROP TABLE GithubTags');
    }
}
