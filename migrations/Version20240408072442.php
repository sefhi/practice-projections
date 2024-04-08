<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408072442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created rrss_user table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rrss_user (id UUID NOT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, profile_picture VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN rrss_user.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE rrss_user');
    }
}
