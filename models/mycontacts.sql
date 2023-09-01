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

-- Contact

CREATE TABLE IF NOT EXISTS contact (

    id INT AUTO_INCREMENT
    , lastname VARCHAR(100) NOT NULL
    , firstname VARCHAR(100) NOT NULL
    , pseudo VARCHAR(100)
    , phone_number VARCHAR(100)
    , email VARCHAR(150)
    , street_address VARCHAR(150)
    , number_address VARCHAR(10)
    , zip_address VARCHAR(10)
    , city_address VARCHAR(150)

    , filename VARCHAR(255)
    , filepath VARCHAR(255)

    , user_id INT

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

    , CONSTRAINT PK_contact PRIMARY KEY (id)
    

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Category

CREATE TABLE IF NOT EXISTS category (

    id INT AUTO_INCREMENT
    , label VARCHAR(100) NOT NULL

    , user_id INT

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

    , CONSTRAINT PK_category PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact List

CREATE TABLE IF NOT EXISTS contact_category (

    contact_id INT
    , category_id INT

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    
    , CONSTRAINT PK_contact_category PRIMARY KEY (contact_id, category_id)
    , CONSTRAINT FK_contact_category_contact FOREIGN KEY (contact_id) REFERENCES contact (id)
    , CONSTRAINT FK_contact_category_category FOREIGN KEY (category_id) REFERENCES category (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Réference des tables
--

ALTER TABLE contact
ADD CONSTRAINT FK_contact_user FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE category
ADD CONSTRAINT FK_category_user FOREIGN KEY (user_id) REFERENCES user (id);

--
-- Remplissage des tables
-- 

INSERT INTO user 
VALUES (NULL, 'Geerts', 'Quentin', '1996-04-03', 'quentin.geerts@bstorm.be', sha2('Test123=', 256), 'admin', DEFAULT, DEFAULT)
