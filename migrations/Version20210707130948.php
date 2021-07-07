<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707130948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE project MODIFY COLUMN feedback_improvement_text LONGTEXT AFTER feedback_pricing_rating');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE project MODIFY COLUMN feedback_improvement_text LONGTEXT AFTER feedback_overall_rating');
    }
}
