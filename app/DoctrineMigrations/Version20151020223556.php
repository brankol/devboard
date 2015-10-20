<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151020223556 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D5428AED1DD861FD ON Users');
        $this->addSql('ALTER TABLE Users ADD githubProfileName VARCHAR(255) DEFAULT NULL, ADD githubUserName VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDDA5BB2E6 ON Users (githubUserName)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D5428AEDDA5BB2E6 ON Users');
        $this->addSql('ALTER TABLE Users DROP githubProfileName, DROP githubUserName');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AED1DD861FD ON Users (profileName)');
    }
}
