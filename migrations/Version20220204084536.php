<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204084536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, publisher, year, isbn, back_cover, cover FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, publisher VARCHAR(255) NOT NULL COLLATE BINARY, year INTEGER NOT NULL, isbn INTEGER NOT NULL, back_cover CLOB NOT NULL COLLATE BINARY, cover BOOLEAN NOT NULL, CONSTRAINT FK_CBE5A331A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, title, publisher, year, isbn, back_cover, cover) SELECT id, title, publisher, year, isbn, back_cover, cover FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A331A76ED395 ON book (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CBE5A331A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, publisher, year, isbn, back_cover, cover FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, publisher VARCHAR(255) NOT NULL, year INTEGER NOT NULL, isbn INTEGER NOT NULL, back_cover CLOB NOT NULL, cover BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO book (id, title, publisher, year, isbn, back_cover, cover) SELECT id, title, publisher, year, isbn, back_cover, cover FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
