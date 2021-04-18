<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223135308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_util (id INT AUTO_INCREMENT NOT NULL, utilitaires_id INT NOT NULL, utilisateurs_id INT NOT NULL, ville VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, UNIQUE INDEX UNIQ_C85F7FCB5F6FB34C (utilitaires_id), UNIQUE INDEX UNIQ_C85F7FCB1E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_util ADD CONSTRAINT FK_C85F7FCB5F6FB34C FOREIGN KEY (utilitaires_id) REFERENCES utilitaires (id)');
        $this->addSql('ALTER TABLE reservation_util ADD CONSTRAINT FK_C85F7FCB1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation_util');
    }
}
