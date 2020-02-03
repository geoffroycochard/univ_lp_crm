<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203141307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, topic VARCHAR(255) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, status TEXT CHECK(status IN (\'open\', \'inprogress\', \'won\', \'lost\')) DEFAULT NULL)');
        $this->addSql('INSERT INTO opportunity (id, topic, date, status) SELECT id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, topic VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status CLOB DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO opportunity (id, topic, date, status) SELECT id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
    }
}
