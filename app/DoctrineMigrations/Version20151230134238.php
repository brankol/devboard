<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151230134238 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GithubHooks (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, repoId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', UNIQUE INDEX UNIQ_EB63001AE52A88D8 (repoId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GithubHooks ADD CONSTRAINT FK_EB63001AE52A88D8 FOREIGN KEY (repoId) REFERENCES GithubRepos (id)');
        $this->addSql('ALTER TABLE GithubRepos ADD hook CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE GithubRepos ADD CONSTRAINT FK_DD984E14A4584355 FOREIGN KEY (hook) REFERENCES GithubHooks (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD984E14A4584355 ON GithubRepos (hook)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE GithubRepos DROP FOREIGN KEY FK_DD984E14A4584355');
        $this->addSql('DROP TABLE GithubHooks');
        $this->addSql('DROP INDEX UNIQ_DD984E14A4584355 ON GithubRepos');
        $this->addSql('ALTER TABLE GithubRepos DROP hook');
    }
}
