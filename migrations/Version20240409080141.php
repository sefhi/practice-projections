<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409080141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create retention_user table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE retention_user (id UUID NOT NULL, name VARCHAR(150) NOT NULL, email VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN retention_user.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE retention_user');
        $this->addSql('DROP INDEX UNIQ_908B8D86E7927C74');
    }
}
