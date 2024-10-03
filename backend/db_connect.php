<?php
function getDB(): PDO|null
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=gestion_produits_commandes', 'dba', '123');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $db; 
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        return null;
    }
}
