<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327210910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created invitation entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE invitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invitation (id INT NOT NULL, the_user_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F11D61A247BCFD73 ON invitation (the_user_id)');
        $this->addSql('COMMENT ON COLUMN invitation.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A247BCFD73 FOREIGN KEY (the_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE invitation_id_seq CASCADE');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A247BCFD73');
        $this->addSql('DROP TABLE invitation');
    }
}
