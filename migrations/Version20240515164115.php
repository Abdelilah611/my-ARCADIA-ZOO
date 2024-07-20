<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515164115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new fields (descriptions and presentations) for Animal, Habitat and Service entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD presentation TEXT NOT NULL');
        $this->addSql('ALTER TABLE habitat ADD long_description TEXT NOT NULL');
        $this->addSql('ALTER TABLE service ADD long_description TEXT NOT NULL');
        $this->addSql('ALTER TABLE service ADD text_btn VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE animal DROP presentation');
        $this->addSql('ALTER TABLE service DROP long_description');
        $this->addSql('ALTER TABLE service DROP text_btn');
        $this->addSql('ALTER TABLE habitat DROP long_description');
    }
}
