<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415083041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add class column to shared_failover_domain_events table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                    Alter table shared_failover_domain_events add column domain_event_class varchar(500)
               SQL

        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                    Alter table shared_failover_domain_events drop column domain_event_class
               SQL

        );
    }
}
