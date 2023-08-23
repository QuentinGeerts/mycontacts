--
-- Base de données : mycontacts
--

--
-- Création de la base de données
-- 

DROP DATABASE IF EXISTS mycontacts;
CREATE DATABASE IF NOT EXISTS mycontacts;

USE mycontacts;

--
-- Création des tables
--

-- User

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (

    id INT AUTO_INCREMENT
    , lastname VARCHAR(100)
    , firstname VARCHAR(100)
    , birthdate DATE
    , email VARCHAR(150) NOT NULL
    , password VARCHAR(256)
    , role ENUM('admin', 'user') DEFAULT 'user'

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP


    , CONSTRAINT PK_user PRIMARY KEY (id)
    , CONSTRAINT UK_email UNIQUE (email)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO user 
VALUES (NULL, 'Geerts', 'Quentin', '1996-04-03', 'quentin.geerts@bstorm.be', sha2('Test123=', 256), 'admin', DEFAULT, DEFAULT)

-- Contact

DROP TABLE IF EXISTS contact;
CREATE TABLE IF NOT EXISTS contact (

    id INT AUTO_INCREMENT
    , lastname VARCHAR(100) NOT NULL
    , firstname VARCHAR(100) NOT NULL
    , pseudo VARCHAR(100)
    , phone_number VARCHAR(100)
    , email VARCHAR(150)
    , adresse postale (optionnel)

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

    , CONSTRAINT PK_contact PRIMARY KEY (id)
    

) ENGINE=InnoDB DEFAULT CHARSET=utfmb4;

-- Category

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS categoty (

    id INT NOT NULL
    , label VARCHAR(100) NOT NULL

    , CONSTRAINT PK_category PRIMARY KEY (id)
    , CONSTRAINT UK_label UNIQUE (label)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact List

DROP TABLE IF EXISTS contact_list;
CREATE TABLE IF NOT EXISTS contact_list (

    owner_id INT NOT NULL
    , contact_id INT NOT NULL
    , category_id INT
    
    , CONSTRAINT FK_owner FOREIGN KEY (owner_id) REFERENCES user (id)
    , CONSTRAINT FK_contact FOREIGN KEY (contact_id) REFERENCES contact (id)
    , CONSTRAINT FK_category FOREIGN KEY (category_id) REFERENCES category (id)

) ENGINE=InnoDB DEFAULT CHARSET=utfmb4;