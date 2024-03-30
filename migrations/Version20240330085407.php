<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240330085407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initialisation du modèle de données';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, etape_id INT DEFAULT NULL, numero INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_285F75DD89312FE9 (recette_id), INDEX IDX_285F75DD4A8CA2AD (etape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, est_vegetarien TINYINT(1) DEFAULT NULL, title VARCHAR(255) NOT NULL, groupe VARCHAR(255) NOT NULL, unite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, date_de_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', titre VARCHAR(255) NOT NULL, duree_de_preparation INT NOT NULL, duree_de_preparation_avec_cuisson INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_49BB639060BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ingredient (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, quantite INT NOT NULL, unite VARCHAR(255) DEFAULT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), UNIQUE INDEX recette_ingredient (recette_id, ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_recette (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, recette_id INT DEFAULT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_33B09402FB88E14F (utilisateur_id), INDEX IDX_33B0940289312FE9 (recette_id), UNIQUE INDEX recette_utilisateur (recette_id, utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_recette_confection (id INT AUTO_INCREMENT NOT NULL, utilisateur_recette_id INT DEFAULT NULL, confectionne_le DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AA59C828BB89EDFF (utilisateur_recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE utilisateur_recette ADD CONSTRAINT FK_33B09402FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE utilisateur_recette ADD CONSTRAINT FK_33B0940289312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE utilisateur_recette_confection ADD CONSTRAINT FK_AA59C828BB89EDFF FOREIGN KEY (utilisateur_recette_id) REFERENCES utilisateur_recette (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD89312FE9');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD4A8CA2AD');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639060BB6FE6');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE utilisateur_recette DROP FOREIGN KEY FK_33B09402FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_recette DROP FOREIGN KEY FK_33B0940289312FE9');
        $this->addSql('ALTER TABLE utilisateur_recette_confection DROP FOREIGN KEY FK_AA59C828BB89EDFF');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ingredient');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_recette');
        $this->addSql('DROP TABLE utilisateur_recette_confection');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
