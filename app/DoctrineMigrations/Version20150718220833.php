<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150718220833 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Users ADD profileName VARCHAR(255) DEFAULT NULL, ADD githubId VARCHAR(255) DEFAULT NULL, ADD githubAccessToken VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE email_canonical email_canonical VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AED1DD861FD ON Users (profileName)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE405124B ON Users (githubId)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDF6A5EC68 ON Users (githubAccessToken)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE7927C74 ON Users (email)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D5428AED1DD861FD ON Users');
        $this->addSql('DROP INDEX UNIQ_D5428AEDE405124B ON Users');
        $this->addSql('DROP INDEX UNIQ_D5428AEDF6A5EC68 ON Users');
        $this->addSql('DROP INDEX UNIQ_D5428AEDE7927C74 ON Users');
        $this->addSql('ALTER TABLE Users DROP profileName, DROP githubId, DROP githubAccessToken, CHANGE email email VARCHAR(255) NOT NULL, CHANGE email_canonical email_canonical VARCHAR(255) NOT NULL');
    }
}
