<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629202329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit ADD partner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D399393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_95DB9D399393F8FE ON deposit (partner_id)');
        $this->addSql('ALTER TABLE withdraw ADD partner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE withdraw ADD CONSTRAINT FK_B5DE5F9E9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_B5DE5F9E9393F8FE ON withdraw (partner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D399393F8FE');
        $this->addSql('DROP INDEX IDX_95DB9D399393F8FE ON deposit');
        $this->addSql('ALTER TABLE deposit DROP partner_id');
        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_B5DE5F9E9393F8FE');
        $this->addSql('DROP INDEX IDX_B5DE5F9E9393F8FE ON withdraw');
        $this->addSql('ALTER TABLE withdraw DROP partner_id');
    }
}
