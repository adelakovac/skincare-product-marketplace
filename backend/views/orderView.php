<?php
require_once __DIR__ . '/../services/orderService.php';

header('Content-Type: application/json');
$service = new OrderService();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($service->getById($_GET['id']));
        } else {
            echo json_encode($service->getAll());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['user_id'], $data['total_price'])) {
            $status = $data['status'] ?? 'pending';
            $result = $service->create($data['user_id'], $data['total_price'], $status);
            echo json_encode(["success" => true, "order_id" => $result]);
        } else {
            echo json_encode(["error" => "Missing required data"]);
        }
        break;

    case 'PUT':
    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['user_id'], $data['total_price'], $data['status'])) {
            $success = $service->update($data['id'], $data['user_id'], $data['total_price'], $data['status']);
            echo json_encode(["success" => $success]);
        } else {
            echo json_encode(["error" => "Missing required data"]);
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
