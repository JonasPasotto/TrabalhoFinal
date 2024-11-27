<?php
// Configurações do banco de dados
$host = 'localhost'; // Nome do host do MySQL
$dbname = 'chamados_ti'; // Nome do banco de dados
$username = 'root'; // Usuário do MySQL
$password = ''; // Senha do MySQL (deixe vazio se estiver usando padrão)

// Conexão com o banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'] ?? null;
    $setor = $_POST['setor'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $observacoes = $_POST['observacoes'] ?? null;

    // Validação básica
    if (!$nome || !$setor || !$descricao) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Insere os dados na tabela
    try {
        $sql = "INSERT INTO chamados (nome, setor, descricao, observacoes) 
                VALUES (:nome, :setor, :descricao, :observacoes)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':setor', $setor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':observacoes', $observacoes);

        $stmt->execute();

        echo "Chamado registrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao salvar o chamado: " . $e->getMessage();
    }
}
?>
