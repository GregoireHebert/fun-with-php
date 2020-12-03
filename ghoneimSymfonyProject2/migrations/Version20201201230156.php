<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201230156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_7A5BC505D22CABCD');
        $this->addSql('DROP INDEX UNIQ_7A5BC505C0990423');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, player1_id, player2_id FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player1_id INTEGER NOT NULL, player2_id INTEGER NOT NULL, CONSTRAINT FK_7A5BC505C0990423 FOREIGN KEY (player1_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7A5BC505D22CABCD FOREIGN KEY (player2_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "match" (id, player1_id, player2_id) SELECT id, player1_id, player2_id FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505D22CABCD ON "match" (player2_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505C0990423 ON "match" (player1_id)');
        $this->addSql('ALTER TABLE player ADD COLUMN password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_7A5BC505C0990423');
        $this->addSql('DROP INDEX UNIQ_7A5BC505D22CABCD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, player1_id, player2_id FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player1_id INTEGER NOT NULL, player2_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO "match" (id, player1_id, player2_id) SELECT id, player1_id, player2_id FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505C0990423 ON "match" (player1_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505D22CABCD ON "match" (player2_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, points, name FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, points DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO player (id, points, name) SELECT id, points, name FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
    }
}
