<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/config.php';

$pdo = getDB();
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_GET['resource'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

try {
    switch ($resource) {

        // ==================== MANUTENÇÕES ====================
        case 'manutencoes':
            if ($method === 'GET') {
                $stmt = $pdo->query("SELECT id, sistema, ultima_manutencao, status, observacao, proxima_manutencao FROM manutencoes ORDER BY FIELD(status, 'Ruim', 'Atenção', 'Bom'), sistema");
                echo json_encode($stmt->fetchAll());

            } elseif ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $stmt = $pdo->prepare("INSERT INTO manutencoes (sistema, ultima_manutencao, status, observacao, proxima_manutencao) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data['sistema'],
                    $data['ultima_manutencao'],
                    $data['status'],
                    $data['observacao'] ?? null,
                    $data['proxima_manutencao']
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId(), 'message' => 'Manutenção cadastrada com sucesso']);

            } elseif ($method === 'PUT' && $id) {
                $data = json_decode(file_get_contents('php://input'), true);
                $stmt = $pdo->prepare("UPDATE manutencoes SET sistema=?, ultima_manutencao=?, status=?, observacao=?, proxima_manutencao=? WHERE id=?");
                $stmt->execute([
                    $data['sistema'],
                    $data['ultima_manutencao'],
                    $data['status'],
                    $data['observacao'] ?? null,
                    $data['proxima_manutencao'],
                    $id
                ]);
                echo json_encode(['success' => true, 'message' => 'Manutenção atualizada com sucesso']);

            } elseif ($method === 'DELETE' && $id) {
                $stmt = $pdo->prepare("DELETE FROM manutencoes WHERE id=?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true, 'message' => 'Manutenção excluída com sucesso']);

            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido']);
            }
            break;

        // ==================== OBRAS ====================
        case 'obras':
            if ($method === 'GET') {
                $stmt = $pdo->query("SELECT id, nome, localizacao, fase, progresso, data_inicio, previsao_entrega, responsavel, observacao FROM obras ORDER BY FIELD(fase, 'Estrutura', 'Fundação', 'Acabamento', 'Planejamento', 'Concluída'), nome");
                echo json_encode($stmt->fetchAll());

            } elseif ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $stmt = $pdo->prepare("INSERT INTO obras (nome, localizacao, fase, progresso, data_inicio, previsao_entrega, responsavel, observacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data['nome'],
                    $data['localizacao'] ?? null,
                    $data['fase'],
                    (int)($data['progresso'] ?? 0),
                    $data['data_inicio'] ?: null,
                    $data['previsao_entrega'] ?: null,
                    $data['responsavel'] ?? null,
                    $data['observacao'] ?? null
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId(), 'message' => 'Obra cadastrada com sucesso']);

            } elseif ($method === 'PUT' && $id) {
                $data = json_decode(file_get_contents('php://input'), true);
                $stmt = $pdo->prepare("UPDATE obras SET nome=?, localizacao=?, fase=?, progresso=?, data_inicio=?, previsao_entrega=?, responsavel=?, observacao=? WHERE id=?");
                $stmt->execute([
                    $data['nome'],
                    $data['localizacao'] ?? null,
                    $data['fase'],
                    (int)($data['progresso'] ?? 0),
                    $data['data_inicio'] ?: null,
                    $data['previsao_entrega'] ?: null,
                    $data['responsavel'] ?? null,
                    $data['observacao'] ?? null,
                    $id
                ]);
                echo json_encode(['success' => true, 'message' => 'Obra atualizada com sucesso']);

            } elseif ($method === 'DELETE' && $id) {
                $stmt = $pdo->prepare("DELETE FROM obras WHERE id=?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true, 'message' => 'Obra excluída com sucesso']);

            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido']);
            }
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Recurso não encontrado. Use ?resource=manutencoes ou ?resource=obras']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro interno: ' . $e->getMessage()]);
}
