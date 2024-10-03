<?php
require_once '../db_connect.php';
require_once '../classes/Produit.php';

$pdo = getDB();
$produit = new Produit($pdo);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($produit->getProduit($_GET['id']));
        } else {
            echo json_encode($produit->getProduits());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $produit->ajouterProduit($data['nom'], $data['description'], $data['prix'], $data['quantite']);
        echo json_encode(["message" => "Produit ajouté avec succès."]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['nom'], $data['description'], $data['prix'], $data['quantite'])) {
            $produit->modifierProduit($data['id'], $data['nom'], $data['description'], $data['prix'], $data['quantite']);
            echo json_encode(["message" => "Produit modifié avec succès."]);
        } else {
            echo json_encode(["message" => "Données manquantes."]);
        }
        break;


    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE['id'])) {
            $produit->supprimerProduit($_DELETE['id']);
            echo json_encode(["message" => "Produit supprimé avec succès."]);
        } else {
            echo json_encode(["message" => "ID de produit manquant."]);
        }
        break;


    default:
        echo json_encode(["message" => "Méthode non supportée"]);
        break;
}
