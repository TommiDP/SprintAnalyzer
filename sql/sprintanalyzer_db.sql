-- DB 
DROP DATABASE IF EXISTS sprintanalyzer_db; 
CREATE DATABASE sprintanalyzer_db; 
USE sprintanalyzer_db;

-- Tabella Utenti (Atleti)
DROP TABLE IF EXISTS utenti;
CREATE TABLE utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabella Risultati Gare 
DROP TABLE IF EXISTS risultati;
CREATE TABLE risultati (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_atleta INT NOT NULL,
    tempo DECIMAL(5,2) NOT NULL,
    distanza VARCHAR(10) NOT NULL, 
    vento DECIMAL(3,1) CHECK (vento BETWEEN -10.0 AND 10.0),
    altitudine INT CHECK (altitudine >= 0),
    data_gara DATE NOT NULL,
    FOREIGN KEY (id_atleta) REFERENCES utenti(id) ON DELETE CASCADE
);