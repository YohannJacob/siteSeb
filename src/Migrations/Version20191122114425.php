<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122114425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums ADD image1file VARCHAR(255) DEFAULT NULL, ADD image1name VARCHAR(255) NOT NULL, ADD image2file VARCHAR(255) DEFAULT NULL, ADD image2name VARCHAR(255) NOT NULL, ADD image3file VARCHAR(255) DEFAULT NULL, ADD image3name VARCHAR(255) NOT NULL, ADD image4file VARCHAR(255) DEFAULT NULL, ADD image4name VARCHAR(255) NOT NULL, ADD image5file VARCHAR(255) DEFAULT NULL, ADD image5name VARCHAR(255) NOT NULL, ADD image6file VARCHAR(255) DEFAULT NULL, ADD image6name VARCHAR(255) NOT NULL, ADD image7file VARCHAR(255) DEFAULT NULL, ADD image7name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums DROP image1file, DROP image1name, DROP image2file, DROP image2name, DROP image3file, DROP image3name, DROP image4file, DROP image4name, DROP image5file, DROP image5name, DROP image6file, DROP image6name, DROP image7file, DROP image7name');
    }
}
