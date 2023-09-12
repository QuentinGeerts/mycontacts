-- 1. Créer une catégorie (user existant)


INSERT INTO category 
    (label, user_id) 
VALUES 
    ('Famille', 1);

INSERT INTO category 
    (label, user_id) 
VALUES 
    ('Collègue', 1);

-- Création des contacts

INSERT INTO contact 
    (lastname, firstname) 
VALUES 
    ('Michel', 'Monpote')
    , ('Henri', 'Henri')
    , ('Marie', 'Tudor');

-- Attribution de catégories à Michel

INSERT INTO contact_category (contact_id, category_id) 
VALUES 
    (2, 1) -- Michel -> Famille
    , (2, 2) -- Michel -> Collègue

-- Récupération des contacts par catégorie

SELECT *
FROM contact c
JOIN
    contact_category ccat
        ON c.id = ccat.contact_id
JOIN
    category cat
        ON cat.id = ccat.category_id
WHERE 
    c.user_id = 1
    AND cat.id = 1;