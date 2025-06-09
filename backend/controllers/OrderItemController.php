<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../services/OrderItemService.php';
$service = new OrderItemService();

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
        if (isset($data['order_id'], $data['product_id'], $data['quantity'], $data['price'])) {
            $id = $service->create($data['order_id'], $data['product_id'], $data['quantity'], $data['price']);
            echo json_encode(["success" => true, "id" => $id]);
        } else {
            echo json_encode(["error" => "Missing required fields"]);
        }
        break;

    case 'PUT':
    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['order_id'], $data['product_id'], $data['quantity'], $data['price'])) {
            $success = $service->update($data['id'], $data['order_id'], $data['product_id'], $data['quantity'], $data['price']);
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
