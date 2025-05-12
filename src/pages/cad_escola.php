<?php

require __DIR__ . "/../class/escola.php";

// Inicializa as variáveis
$nome = $cnpj =$endereco =$cidade = "";
$escolaCriado = false;

//Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $cnpj = trim($_POST["cnpj"]);
    $endereco = trim($_POST["endereco"]);
    $cidade = trim($_POST["cidade"]);
    try {
        $escola = new Escola($nome, $cnpj, $endereco, $cidade);
        $escolaCriado = true;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
    }
}
?>


<h2>Cadastro de Escola</h2>

<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($nome) ?>">
    </div>

    <div class="col-md-2">
        <label for="cnpj" class="form-label">CNPJ:</label>
        <input type="number" name="cnpj" id="cnpj" class="form-control" value="<?= htmlspecialchars($cnpj) ?>">
    </div>

    <div class="col-md-4">
        <label for="endereco" class="form-label">Endereço:</label>
        <input type="text" name="endereco" id="endereco" class="form-control" value="<?= htmlspecialchars($endereco) ?>">
    </div>

    <div class="col-md-2">
        <label for="cidade" class="form-label">Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="<?= htmlspecialchars($cidade) ?>">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<?php
if ($escolaCriado) {
echo "<h3>Resultado:</h3>";
$escola->exibirDados();
}
