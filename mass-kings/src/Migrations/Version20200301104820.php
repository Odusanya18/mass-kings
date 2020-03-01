<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301104820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__appointment AS SELECT id, location, time, contact_name, contact_phone, contact_email, package FROM appointment');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location VARCHAR(255) NOT NULL COLLATE BINARY, time DATETIME NOT NULL --(DC2Type:datetimetz_immutable)
        , contact_name VARCHAR(255) NOT NULL COLLATE BINARY, contact_phone VARCHAR(255) NOT NULL COLLATE BINARY, contact_email VARCHAR(255) NOT NULL COLLATE BINARY, package INTEGER NOT NULL)');
        $this->addSql('INSERT INTO appointment (id, location, time, contact_name, contact_phone, contact_email, package) SELECT id, location, time, contact_name, contact_phone, contact_email, package FROM __temp__appointment');
        $this->addSql('DROP TABLE __temp__appointment');
        $this->addSql('CREATE INDEX time_valid_idx ON appointment (time)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX time_valid_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__appointment AS SELECT id, package, location, time, contact_name, contact_phone, contact_email FROM appointment');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, package INTEGER NOT NULL, location VARCHAR(255) NOT NULL, time DATETIME NOT NULL --(DC2Type:datetimetz_immutable)
        , contact_name VARCHAR(255) NOT NULL, contact_phone VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO appointment (id, package, location, time, contact_name, contact_phone, contact_email) SELECT id, package, location, time, contact_name, contact_phone, contact_email FROM __temp__appointment');
        $this->addSql('DROP TABLE __temp__appointment');
    }
}
