<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007073715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, id_bien_id INT DEFAULT NULL, suite VARCHAR(50) DEFAULT NULL, INDEX IDX_B09C8CBB6308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_visiteur (visite_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_9C620330C1C5DC59 (visite_id), INDEX IDX_9C6203307F72333D (visiteur_id), PRIMARY KEY(visite_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nb_piece (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, id_type_id INT DEFAULT NULL, nb_piece INT DEFAULT NULL, nb_chambre INT DEFAULT NULL, superficie INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, chauffage TINYINT(1) DEFAULT NULL, annee VARCHAR(5) DEFAULT NULL, localisation VARCHAR(70) DEFAULT NULL, etat VARCHAR(50) DEFAULT NULL, INDEX IDX_45EDC3861BD125E3 (id_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(50) DEFAULT NULL, telephone VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB6308117F FOREIGN KEY (id_bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE visite_visiteur ADD CONSTRAINT FK_9C620330C1C5DC59 FOREIGN KEY (visite_id) REFERENCES visite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_visiteur ADD CONSTRAINT FK_9C6203307F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3861BD125E3 FOREIGN KEY (id_type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_visiteur DROP FOREIGN KEY FK_9C620330C1C5DC59');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB6308117F');
        $this->addSql('ALTER TABLE visite_visiteur DROP FOREIGN KEY FK_9C6203307F72333D');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC3861BD125E3');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE visite_visiteur');
        $this->addSql('DROP TABLE nb_piece');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE visiteur');
        $this->addSql('DROP TABLE type');
    }
}
