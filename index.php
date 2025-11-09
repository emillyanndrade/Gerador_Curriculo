<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Currículo Generator</a>
  </div>
</nav>

<div class="container">
    <h2>Formulário de Dados Pessoais</h2>
    <form action="gerar_curriculo.php" method="POST" id="formCurriculo">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>

        <div class="mb-3">
            <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required>
        </div>

        <div class="mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input type="text" class="form-control" name="idade" id="idade" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="telefone" required>
        </div>

        <h4>Experiências Profissionais</h4>
        <div id="experiencias">
            <input type="text" class="form-control mb-2" name="experiencia[]" placeholder="Experiência 1">
        </div>
        <button type="button" id="add-experiencia" class="btn btn-sm btn-success mb-3">+ Adicionar Experiência</button>

        <h4>Referências Pessoais</h4>
        <div id="referencias">
            <input type="text" class="form-control mb-2" name="referencia[]" placeholder="Referência 1">
        </div>
        <button type="button" id="add-referencia" class="btn btn-sm btn-success mb-3">+ Adicionar Referência</button>

        <button type="submit" class="btn btn-primary">Gerar Currículo</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php
// Inicializando variáveis para evitar warnings
$nome = $dataNascimento = $idade = $email = $telefone = '';
$experiencias = [];
$referencias = [];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $dataNascimento = $_POST['dataNascimento'] ?? '';
    $idade = $_POST['idade'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $experiencias = $_POST['experiencia'] ?? [];
    $referencias = $_POST['referencia'] ?? [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo Gerado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Currículo Generator</a>
  </div>
</nav>

<div class="container">
    <h2>Currículo Gerado</h2>

    <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
    <p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($dataNascimento) ?></p>
    <p><strong>Idade:</strong> <?= htmlspecialchars($idade) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($telefone) ?></p>

    <h4>Experiências Profissionais</h4>
    <ul>
        <?php if(!empty($experiencias)): ?>
            <?php foreach($experiencias as $exp): ?>
                <?php if(!empty($exp)): ?>
                    <li><?= nl2br(htmlspecialchars($exp)) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Não há experiências adicionadas.</li>
        <?php endif; ?>
    </ul>

    <h4>Referências Pessoais</h4>
    <ul>
        <?php if(!empty($referencias)): ?>
            <?php foreach($referencias as $ref): ?>
                <?php if(!empty($ref)): ?>
                    <li><?= nl2br(htmlspecialchars($ref)) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Não há referências adicionadas.</li>
        <?php endif; ?>
    </ul>

    <button onclick="window.print()" class="btn btn-success">Imprimir / Download</button>
    <a href="index.php" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>

<script>
$(document).ready(function() {
    console.log("Script funcionando!");

    // exemplo: calcular idade
    $('#dataNascimento').on('change', function() {
        let dataNascimento = new Date($(this).val());
        let hoje = new Date();
        let idade = hoje.getFullYear() - dataNascimento.getFullYear();
        let m = hoje.getMonth() - dataNascimento.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < dataNascimento.getDate())) {
            idade--;
        }
        $('#idade').val(idade);
    });

    // Adicionar experiência
    $('#add-experiencia').click(function() {
        let count = $('#experiencias input').length + 1;
        $('#experiencias').append('<input type="text" class="form-control mb-2" name="experiencia[]" placeholder="Experiência ' + count + '">');
    });

    // Adicionar referência
    $('#add-referencia').click(function() {
        let count = $('#referencias input').length + 1;
        $('#referencias').append('<input type="text" class="form-control mb-2" name="referencia[]" placeholder="Referência ' + count + '">');
    });
});
</script>






