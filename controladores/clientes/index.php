<?php
require '../../models/clientes.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = isset($_REQUEST['tipo']) ? intval($_REQUEST['tipo']) : 0;

try {
    switch ($metodo) {
        case 'POST':
            $cliente = new Cliente($_POST);
            switch ($tipo) {
                case 1:
                    $ejecucion = $cliente->guardar();
                    $mensaje = "Cliente guardado correctamente";
                    break;
                case 2:
                    $ejecucion = $cliente->modificar();
                    $mensaje = "Cliente modificado correctamente";
                    break;
                case 3:
                    $ejecucion = $cliente->eliminar();
                    $mensaje = "Cliente eliminado correctamente";
                    break;
                default:
                    throw new Exception("Tipo de operación no válido.");
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => 1,
            ]);
            break;

        case 'GET':
            $cliente = new Cliente($_GET);
            $clientes = $cliente->buscar();
            http_response_code(200);
            echo json_encode($clientes);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;
