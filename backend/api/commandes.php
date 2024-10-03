<?php
require_once '../db_connect.php';
require_once '../classes/Commande.php';

$pdo = getDB();
$commande = new Commande($pdo);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($commande->getCommande($_GET['id']));
        } else {
            echo json_encode($commande->getCommandes());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['nom_client'], $data['date_commande'])) {
            $commande->ajouterCommande($data['nom_client'], $data['date_commande']);
            echo json_encode(["message" => "Commande ajoutée avec succès."]);
        } else {
            echo json_encode(["message" => "Paramètres manquants."], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);

        if (isset($_PUT['id']) && isset($_PUT['nom_client']) && isset($_PUT['date_commande'])) {
            $commandeExistante = $commande->getCommande($_PUT['id']);
            if ($commandeExistante) {
                $commande->modifierCommande($_PUT['id'], $_PUT['nom_client'], $_PUT['date_commande']);
                echo json_encode(["message" => "Commande modifiée avec succès."]);
            } else {
                echo json_encode(["message" => "Commande introuvable."], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(["message" => "Paramètres manquants pour la modification."], JSON_UNESCAPED_UNICODE);
        }
        break;


    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE['id'])) {
            $commande->supprimerCommande($_DELETE['id']);
            echo json_encode(["message" => "Commande supprimée avec succès."]);
        } else {
            echo json_encode(["message" => "ID de la commande manquant."], JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        echo json_encode(["message" => "Méthode non supportée"], JSON_UNESCAPED_UNICODE);
        break;
}
