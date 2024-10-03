<?php
require 'backend/db_connect.php';  
require 'backend/produits.php';    

function afficherResultat($testName, $resultat) {
    echo "$testName : " . ($resultat['success'] ?? false ? "Réussi" : "Échoué - " . $resultat['message']) . PHP_EOL;
}

// Connexion à la base de données
$pdo = getDB();
$produit = new Produit($pdo);

// 1. Ajouter un produit avec des données valides
$resultat = $produit->ajouterProduit("Produit Test", "Description du produit", 10.99, 5);
afficherResultat("Ajouter un produit avec des données valides", $resultat);

// 2. Ajouter un produit avec un nom vide
$resultat = $produit->ajouterProduit("", "Description du produit", 10.99, 5);
afficherResultat("Ajouter un produit avec un nom vide", $resultat);

// 3. Ajouter un produit avec une description vide
$resultat = $produit->ajouterProduit("Produit Test 2", "", 10.99, 5);
afficherResultat("Ajouter un produit avec une description vide", $resultat);

// 4. Ajouter un produit avec un stock négatif
$resultat = $produit->ajouterProduit("Produit Test 3", "Description du produit", 10.99, -5);
afficherResultat("Ajouter un produit avec un stock négatif", $resultat);

// 5. Ajouter un produit avec un prix négatif
$resultat = $produit->ajouterProduit("Produit Test 4", "Description du produit", -10.99, 5);
afficherResultat("Ajouter un produit avec un prix négatif", $resultat);

// 6. Ajouter un produit sans prix
$resultat = $produit->ajouterProduit("Produit Test 5", "Description du produit", null, 5);
afficherResultat("Ajouter un produit sans prix", $resultat);

// 7. Ajouter un produit sans stock
$resultat = $produit->ajouterProduit("Produit Test 6", "Description du produit", 10.99, null);
afficherResultat("Ajouter un produit sans stock", $resultat);

// 8. Ajouter un produit sans description
$resultat = $produit->ajouterProduit("Produit Test 7", null, 10.99, 5);
afficherResultat("Ajouter un produit sans description", $resultat);

// 9. Modifier un produit avec des données valides
$resultat = $produit->modifierProduit(1, "Produit Modifié", "Description modifiée", 15.99, 10);
afficherResultat("Modifier un produit avec des données valides", $resultat);

// 10. Modifier un produit avec un nom vide
$resultat = $produit->modifierProduit(1, "", "Description modifiée", 15.99, 10);
afficherResultat("Modifier un produit avec un nom vide", $resultat);

// 11. Modifier un produit avec une description vide
$resultat = $produit->modifierProduit(1, "Produit Modifié 2", "", 15.99, 10);
afficherResultat("Modifier un produit avec une description vide", $resultat);

// 12. Modifier un produit avec un stock négatif
$resultat = $produit->modifierProduit(1, "Produit Modifié 3", "Description modifiée", 15.99, -10);
afficherResultat("Modifier un produit avec un stock négatif", $resultat);

// 13. Modifier un produit avec un prix négatif
$resultat = $produit->modifierProduit(1, "Produit Modifié 4", "Description modifiée", -15.99, 10);
afficherResultat("Modifier un produit avec un prix négatif", $resultat);

// 14. Modifier un produit sans prix
$resultat = $produit->modifierProduit(1, "Produit Modifié 5", "Description modifiée", null, 10);
afficherResultat("Modifier un produit sans prix", $resultat);

// 15. Modifier un produit sans stock
$resultat = $produit->modifierProduit(1, "Produit Modifié 6", "Description modifiée", 15.99, null);
afficherResultat("Modifier un produit sans stock", $resultat);

// 16. Modifier un produit sans description
$resultat = $produit->modifierProduit(1, "Produit Modifié 7", null, 15.99, 10);
afficherResultat("Modifier un produit sans description", $resultat);

// 17. Supprimer un produit
$resultat = $produit->supprimerProduit(1);
afficherResultat("Supprimer un produit", $resultat);

// 18. Lister les produits
$produits = $produit->getProduits();
afficherResultat("Lister les produits", ["success" => true, "message" => "Produits récupérés : " . count($produits)]);


