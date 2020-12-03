<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203103919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CCE455F7F1849495');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lobby AS SELECT id FROM lobby');
        $this->addSql('DROP TABLE lobby');
        $this->addSql('CREATE TABLE lobby (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO lobby (id) SELECT id FROM __temp__lobby');
        $this->addSql('DROP TABLE __temp__lobby');
        $this->addSql('DROP INDEX IDX_7A5BC50599C4036B');
        $this->addSql('DROP INDEX IDX_7A5BC5058B71AC85');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, player_a_id, player_b_id, score_player_a, score_player_b, status FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_a_id INTEGER DEFAULT NULL, player_b_id INTEGER DEFAULT NULL, score_player_a DOUBLE PRECISION DEFAULT NULL, score_player_b DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_7A5BC50599C4036B FOREIGN KEY (player_a_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7A5BC5058B71AC85 FOREIGN KEY (player_b_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "match" (id, player_a_id, player_b_id, score_player_a, score_player_b, status) SELECT id, player_a_id, player_b_id, score_player_a, score_player_b, status FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE INDEX IDX_7A5BC50599C4036B ON "match" (player_a_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5058B71AC85 ON "match" (player_b_id)');
        $this->addSql('DROP INDEX UNIQ_98197A65F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, username, roles, password, ratio FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lobby_map_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE BINARY, ratio DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_98197A65B6A31555 FOREIGN KEY (lobby_map_id) REFERENCES lobby (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player (id, username, roles, password, ratio) SELECT id, username, roles, password, ratio FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65F85E0677 ON player (username)');
        $this->addSql('CREATE INDEX IDX_98197A65B6A31555 ON player (lobby_map_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lobby AS SELECT id FROM lobby');
        $this->addSql('DROP TABLE lobby');
        $this->addSql('CREATE TABLE lobby (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, players_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO lobby (id) SELECT id FROM __temp__lobby');
        $this->addSql('DROP TABLE __temp__lobby');
        $this->addSql('CREATE INDEX IDX_CCE455F7F1849495 ON lobby (players_id)');
        $this->addSql('DROP INDEX IDX_7A5BC50599C4036B');
        $this->addSql('DROP INDEX IDX_7A5BC5058B71AC85');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, player_a_id, player_b_id, score_player_a, score_player_b, status FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_a_id INTEGER DEFAULT NULL, player_b_id INTEGER DEFAULT NULL, score_player_a DOUBLE PRECISION DEFAULT NULL, score_player_b DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "match" (id, player_a_id, player_b_id, score_player_a, score_player_b, status) SELECT id, player_a_id, player_b_id, score_player_a, score_player_b, status FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE INDEX IDX_7A5BC50599C4036B ON "match" (player_a_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5058B71AC85 ON "match" (player_b_id)');
        $this->addSql('DROP INDEX UNIQ_98197A65F85E0677');
        $this->addSql('DROP INDEX IDX_98197A65B6A31555');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, username, roles, password, ratio FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, ratio DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO player (id, username, roles, password, ratio) SELECT id, username, roles, password, ratio FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65F85E0677 ON player (username)');
    }
}
