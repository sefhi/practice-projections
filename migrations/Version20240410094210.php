<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410094210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create rrss_post table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rrss_post (id UUID NOT NULL, user_id UUID NOT NULL, content VARCHAR(255) NOT NULL, likes INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN rrss_post.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN rrss_post.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN rrss_post.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN rrss_post.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE rrss_post');
    }
}
