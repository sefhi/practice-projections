<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415065659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created shared_failover_domain_events table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE shared_failover_domain_events (event_id UUID NOT NULL, event_name varchar(255), body json, PRIMARY KEY(event_id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE shared_failover_domain_events');
    }
}
