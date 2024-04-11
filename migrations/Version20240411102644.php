<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411102644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add total_posts and average_post_likes to retention_user table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retention_user ADD total_posts INT NOT NULL DEFAULT 0');
        $this->addSql('ALTER TABLE retention_user ADD average_post_likes DOUBLE PRECISION NOT NULL DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retention_user DROP total_posts');
        $this->addSql('ALTER TABLE retention_user DROP average_post_likes');
    }
}
