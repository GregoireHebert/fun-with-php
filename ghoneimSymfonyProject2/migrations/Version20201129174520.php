<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201129174520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player1_id INTEGER NOT NULL, player2_id INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505C0990423 ON "match" (player1_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A5BC505D22CABCD ON "match" (player2_id)');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, points DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "match"');
        $this->addSql('DROP TABLE player');
    }
}
