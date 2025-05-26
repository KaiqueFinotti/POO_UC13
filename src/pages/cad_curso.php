<?php
include "src/class/curso.php";

// Inicializa as variáveis
$titulo = $horas = $dias = $aluno = "";
$cursoCriado = false;

// Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"]);
    $horas = trim($_POST["horas"]);
    $dias = trim($_POST["dias"]);
    $aluno = trim($_POST["aluno"]);

    try {
        $curso = new Curso($titulo, $horas, $dias, $aluno);

        // Só depois de instanciar, você chama o método
        if ($curso->salvarNoBanco()) {
            echo "<div class='alert alert-success'>Cadastro efetuado com sucesso</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Erro ao salvar no banco de dados.</div>";
        }

    } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
    }
}
$cursos = Curso::listar(); // Método para listar cursos
?>

<h2>Cadastro de Curso</h2>

<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($titulo) ?>">
    </div>

    <div class="col-md-2">
        <label for="horas" class="form-label">Horas:</label>
        <input type="number" name="horas" id="horas" class="form-control" value="<?= htmlspecialchars($horas) ?>">
    </div>

    <div class="col-md-1">
        <label for="dias" class="form-label">Dias:</label>
        <input type="text" name="dias" id="dias" class="form-control" value="<?= htmlspecialchars($dias) ?>">
    </div>

    <div class="col-md-5">
        <label for="aluno" class="form-label">Aluno:</label>
        <input type="text" name="aluno" id="aluno" class="form-control" value="<?= htmlspecialchars($aluno) ?>">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<?php
if ($cursoCriado && $curso !== null) {
    echo "<h3>Resultado:</h3>";
    $curso->exibirDados();
}
?>

<h3>Lista de Curso</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>titulo</th>
            <th>dias</th>
            <th>horas</th>
        </tr>
    </thead>
    <tbody>
       <?php if ($cursos && count($cursos) > 0): ?>
            <?php foreach ($cursos as $curso1): ?>
                <tr>
                    <td><?= htmlspecialchars($curso1['titulo']) ?></td>
                    <td><?= htmlspecialchars($curso1['dias']) ?></td>
                    <td><?= htmlspecialchars($curso1['horas']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Nenhum curso cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
