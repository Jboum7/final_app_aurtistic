<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260703230948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make category name unique';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            'DROP INDEX UNIQ_64C19C15E237E06 ON category'
        );
    }
}
