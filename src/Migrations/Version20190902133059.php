<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902133059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slider ADD album_id INT NOT NULL');
        $this->addSql('ALTER TABLE slider ADD CONSTRAINT FK_CFC710071137ABCF FOREIGN KEY (album_id) REFERENCES albums (id)');
        $this->addSql('CREATE INDEX IDX_CFC710071137ABCF ON slider (album_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slider DROP FOREIGN KEY FK_CFC710071137ABCF');
        $this->addSql('DROP INDEX IDX_CFC710071137ABCF ON slider');
        $this->addSql('ALTER TABLE slider DROP album_id');
    }
}
