<?php
require_once ("modelos/model_temas.php");
?>

<head>
    <title>Prolitab | Temas de la Industria</title>
</head>

<body class="industry-body">

    <?php
    $Id = "";
    $Titulo = "";
    $Descripcion = "";
    $TpFileTem = "";
    $FileTem = "";
    $IdFile = "";

    if (isset($dtviewtema)) {
        foreach ($dtviewtema as $row):
            $Id = $row["IdTema"] ?? "";
            $Titulo = $row["Titulo"] ?? "";
            $Descripcion = $row["Descripcion"] ?? "";
            $TpFileTem = $row["Tipo"] ?? "";
            $FileTem = $row["Archivo"] ?? "";
            $IdFile = $row["IdArchivo"] ?? "";
        endforeach;
    }

    ?>
    <header>
        <h1 class="text-center"><?= $Titulo ?></h1>
    </header>

    <main id="industry-container">
    </main>
</body>