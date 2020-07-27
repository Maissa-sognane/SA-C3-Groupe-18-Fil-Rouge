<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200727214513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_groupe_competence (competence_id INT NOT NULL, groupe_competence_id INT NOT NULL, INDEX IDX_8A72A47315761DAB (competence_id), INDEX IDX_8A72A47389034830 (groupe_competence_id), PRIMARY KEY(competence_id, groupe_competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_competence (id INT AUTO_INCREMENT NOT NULL, groupe_comp_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_2C3959A38B6ADC85 (groupe_comp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_user (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, statut VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_257BA9FE139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, criter_evaluation LONGTEXT NOT NULL, groupe_action VARCHAR(255) NOT NULL, relation VARCHAR(255) NOT NULL, INDEX IDX_4BDFF36BB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, referentiel_id INT DEFAULT NULL, promotion_id INT DEFAULT NULL, langue VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, fabrique VARCHAR(255) NOT NULL, date_fin_provisoire DATE NOT NULL, etat VARCHAR(255) DEFAULT NULL, INDEX IDX_C11D7DD1805DB139 (referentiel_id), INDEX IDX_C11D7DD1139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referentiel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, presentation LONGTEXT DEFAULT NULL, competence_visee LONGTEXT DEFAULT NULL, programme LONGTEXT DEFAULT NULL, critere_evaluation VARCHAR(255) NOT NULL, critere_admission VARCHAR(255) NOT NULL, admission VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referentiel_groupe_competence (referentiel_id INT NOT NULL, groupe_competence_id INT NOT NULL, INDEX IDX_EC387D5B805DB139 (referentiel_id), INDEX IDX_EC387D5B89034830 (groupe_competence_id), PRIMARY KEY(referentiel_id, groupe_competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_groupe_tags (tags_id INT NOT NULL, groupe_tags_id INT NOT NULL, INDEX IDX_103B80638D7B4FB4 (tags_id), INDEX IDX_103B80634B1CA8FA (groupe_tags_id), PRIMARY KEY(tags_id, groupe_tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_groupe_competence ADD CONSTRAINT FK_8A72A47315761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_groupe_competence ADD CONSTRAINT FK_8A72A47389034830 FOREIGN KEY (groupe_competence_id) REFERENCES groupe_competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_competence ADD CONSTRAINT FK_2C3959A38B6ADC85 FOREIGN KEY (groupe_comp_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupe_user ADD CONSTRAINT FK_257BA9FE139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36BB3E9C81 FOREIGN KEY (niveau_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1139DF194 FOREIGN KEY (promotion_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE referentiel_groupe_competence ADD CONSTRAINT FK_EC387D5B805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referentiel_groupe_competence ADD CONSTRAINT FK_EC387D5B89034830 FOREIGN KEY (groupe_competence_id) REFERENCES groupe_competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_groupe_tags ADD CONSTRAINT FK_103B80638D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_groupe_tags ADD CONSTRAINT FK_103B80634B1CA8FA FOREIGN KEY (groupe_tags_id) REFERENCES groupe_tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence_groupe_competence DROP FOREIGN KEY FK_8A72A47315761DAB');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36BB3E9C81');
        $this->addSql('ALTER TABLE competence_groupe_competence DROP FOREIGN KEY FK_8A72A47389034830');
        $this->addSql('ALTER TABLE referentiel_groupe_competence DROP FOREIGN KEY FK_EC387D5B89034830');
        $this->addSql('ALTER TABLE tags_groupe_tags DROP FOREIGN KEY FK_103B80634B1CA8FA');
        $this->addSql('ALTER TABLE groupe_user DROP FOREIGN KEY FK_257BA9FE139DF194');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1805DB139');
        $this->addSql('ALTER TABLE referentiel_groupe_competence DROP FOREIGN KEY FK_EC387D5B805DB139');
        $this->addSql('ALTER TABLE tags_groupe_tags DROP FOREIGN KEY FK_103B80638D7B4FB4');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_groupe_competence');
        $this->addSql('DROP TABLE groupe_competence');
        $this->addSql('DROP TABLE groupe_tags');
        $this->addSql('DROP TABLE groupe_user');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE referentiel');
        $this->addSql('DROP TABLE referentiel_groupe_competence');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_groupe_tags');
    }
}
