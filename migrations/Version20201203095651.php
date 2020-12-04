<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203095651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lobby (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, all_players CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_a_id INTEGER DEFAULT NULL, player_b_id INTEGER DEFAULT NULL, score_player_a DOUBLE PRECISION DEFAULT NULL, score_player_b DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7A5BC50599C4036B ON "match" (player_a_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5058B71AC85 ON "match" (player_b_id)');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, ratio DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65F85E0677 ON player (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lobby');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('DROP TABLE player');
    }
}
