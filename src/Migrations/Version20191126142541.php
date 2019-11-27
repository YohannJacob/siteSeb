<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126142541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums CHANGE image1name image1name VARCHAR(255) DEFAULT NULL, CHANGE image2name image2name VARCHAR(255) DEFAULT NULL, CHANGE image3name image3name VARCHAR(255) DEFAULT NULL, CHANGE image4name image4name VARCHAR(255) DEFAULT NULL, CHANGE image5name image5name VARCHAR(255) DEFAULT NULL, CHANGE image6name image6name VARCHAR(255) DEFAULT NULL, CHANGE image7name image7name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums CHANGE image1name image1name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image2name image2name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image3name image3name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image4name image4name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image5name image5name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image6name image6name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image7name image7name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
