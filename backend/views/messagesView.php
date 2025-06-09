<?php
require_once __DIR__ . '/../services/messagesService.php';
require_once __DIR__ . '/../config/db.php'; // Trebaš imati konekciju kao $db

$service = new MessagesService($db);

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($service->getMessageById($_GET['id']));
        } elseif (isset($_GET['user_id'])) {
            echo json_encode($service->getMessagesByUserId($_GET['user_id']));
        } elseif (isset($_GET['product_id'])) {
            echo json_encode($service->getMessagesByProductId($_GET['product_id']));
        } else {
            echo json_encode($service->getAllMessages());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['user_id'], $data['product_id'], $data['message'])) {
            $result = $service->addMessage($data['user_id'], $data['product_id'], $data['message']);
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Missing data"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $service->deleteMessage($_GET['id']);
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Missing ID"]);
        }
        break;

    default:
        echo json_encode(["error" => "Unsupported request method"]);
        break;
}
?>
