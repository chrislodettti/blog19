<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308151840 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY fk_comments_posts1');
        $this->addSql('ALTER TABLE posts_has_tags DROP FOREIGN KEY fk_posts_has_tags_posts1');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY fk_users_rols');
        $this->addSql('ALTER TABLE posts_has_tags DROP FOREIGN KEY fk_posts_has_tags_tags1');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY fk_comments_users1');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY fk_posts_users1');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE posts_has_tags');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT NOT NULL, posts_id INT NOT NULL, users_id INT UNSIGNED NOT NULL, comment VARCHAR(45) NOT NULL COLLATE utf8_general_ci, create_date DATETIME NOT NULL, INDEX fk_comments_posts1_idx (posts_id), INDEX fk_comments_users1_idx (users_id), PRIMARY KEY(id, posts_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT NOT NULL, users_id INT UNSIGNED NOT NULL, title VARCHAR(45) NOT NULL COLLATE utf8_general_ci, content TEXT NOT NULL COLLATE utf8_general_ci, create_date DATETIME DEFAULT NULL, modify_date DATETIME DEFAULT NULL, INDEX fk_posts_users1_idx (users_id), PRIMARY KEY(id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_has_tags (posts_id INT NOT NULL, posts_users_id INT UNSIGNED NOT NULL, tags_idtags INT NOT NULL, INDEX fk_posts_has_tags_tags1_idx (tags_idtags), INDEX fk_posts_has_tags_posts1_idx (posts_id, posts_users_id), PRIMARY KEY(posts_id, posts_users_id, tags_idtags)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, rol VARCHAR(45) NOT NULL COLLATE utf8_general_ci, description VARCHAR(45) DEFAULT NULL COLLATE utf8_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (idtags INT NOT NULL, tagname VARCHAR(45) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(idtags)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, rols_id INT NOT NULL, username VARCHAR(45) NOT NULL COLLATE utf8_general_ci, password VARCHAR(70) NOT NULL COLLATE utf8_general_ci, lastlogin DATETIME DEFAULT NULL, email VARCHAR(45) NOT NULL COLLATE utf8_general_ci, INDEX fk_users_rols_idx (rols_id), PRIMARY KEY(id, rols_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_comments_posts1 FOREIGN KEY (posts_id) REFERENCES posts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_comments_users1 FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT fk_posts_users1 FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE posts_has_tags ADD CONSTRAINT fk_posts_has_tags_posts1 FOREIGN KEY (posts_id, posts_users_id) REFERENCES posts (id, users_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE posts_has_tags ADD CONSTRAINT fk_posts_has_tags_tags1 FOREIGN KEY (tags_idtags) REFERENCES tags (idtags) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT fk_users_rols FOREIGN KEY (rols_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
