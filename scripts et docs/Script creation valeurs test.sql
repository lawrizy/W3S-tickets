-- Insertion de valeurs test dans les tables de la DB

USE `db_ticketing`;

-- Lieu
INSERT INTO lieu VALUES('', '1, rue fausse', 'Bruxelles');
INSERT INTO lieu VALUES('', '10, fausse rue', 'Bruxelles');

-- Locataire
-- Note: Ajouter un check pour les emails dans le code.
-- Note: saler et hasher les mots de passe dans le code.
INSERT INTO locataire VALUES('', 'Mr. Test', 'a@b.com', 'azerty', 1);
INSERT INTO locataire VALUES('', 'Mme. Test', 'a@b.com', 'azertu', 2);

-- Categorie Incident
-- Note ajouter des catégories et sous-catégories incident par défaut (et les lier entre elles si besoin)
INSERT INTO categorie_incident VALUES('', 'Categorie test');
INSERT INTO categorie_incident VALUES('', 'Categorie test 2');

-- Insertion d'un ticket
INSERT INTO ticket VALUES('', '', 2, 2, 1);
-- Update d'un ticket
UPDATE ticket SET fk_idStatutTicket = 2 WHERE idTicket = 1;