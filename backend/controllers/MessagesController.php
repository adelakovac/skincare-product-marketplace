<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../services/MessagesService.php';
$service = new MessagesService();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($service->getById($_GET['id']));
        } elseif (isset($_GET['user_id'])) {
            echo json_encode($service->getMessagesByUserId($_GET['user_id']));
        } elseif (isset($_GET['product_id'])) {
            echo json_encode($service->getMessagesByProductId($_GET['product_id']));
        } else {
            echo json_encode($service->getAll());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['user_id'], $data['product_id'], $data['message'])) {
            $id = $service->create($data['user_id'], $data['product_id'], $data['message']);
            echo json_encode(["success" => true, "id" => $id]);
        } else {
            echo json_encode(["error" => "Missing required fields"]);
        }
        break;

    case 'PUT':
    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['user_id'], $data['product_id'], $data['message'])) {
            $success = $service->update($data['id'], $data['user_id'], $data['product_id'], $data['message']);
            echo json_encode(["success" => $success]);
        } else {
            echo json_encode(["error" => "Missing data for update"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $success = $service->delete($_GET['id']);
            echo json_encode(["success" => $success]);
        } else {
            echo json_encode(["error" => "Missing ID"]);
        }
        break;

    default:
        echo json_encode(["error" => "Unsupported method"]);
}
?>
