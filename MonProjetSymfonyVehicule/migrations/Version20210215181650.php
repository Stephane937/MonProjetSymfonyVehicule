<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215181650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD voitures_id INT NOT NULL, ADD utilisateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CCC4661F FOREIGN KEY (voitures_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955CCC4661F ON reservation (voitures_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849551E969C5 ON reservation (utilisateurs_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CCC4661F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551E969C5');
        $this->addSql('DROP INDEX UNIQ_42C84955CCC4661F ON reservation');
        $this->addSql('DROP INDEX UNIQ_42C849551E969C5 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP voitures_id, DROP utilisateurs_id');
    }
}
