<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260708141711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add theme field to setting table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE setting ADD theme VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE setting DROP theme');
    }
}
