<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116173701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds standard user properties to schema';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD middle_names VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD date_of_birth DATETIME NOT NULL, ADD profile_picture_storage_key VARCHAR(255) NOT NULL, ADD bio VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP first_name, DROP middle_names, DROP last_name, DROP date_of_birth, DROP profile_picture_storage_key, DROP bio');
    }
}
