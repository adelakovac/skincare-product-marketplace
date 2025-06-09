<?php
require_once __DIR__ . '/../services/reviewService.php';

header('Content-Type: application/json');
$service = new ReviewService();

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
        if (isset($data['user_id'], $data['product_id'], $data['rating'], $data['comment'])) {
            $id = $service->create($data['user_id'], $data['product_id'], $data['rating'], $data['comment']);
            echo json_encode(["success" => true, "review_id" => $id]);
        } else {
            echo json_encode(["error" => "Missing required fields"]);
        }
        break;

    case 'PUT':
    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['user_id'], $data['product_id'], $data['rating'], $data['comment'])) {
            $success = $service->update($data['id'], $data['user_id'], $data['product_id'], $data['rating'], $data['comment']);
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
        echo json_encode(["error" => "Unsupported request method"]);
}
?>
