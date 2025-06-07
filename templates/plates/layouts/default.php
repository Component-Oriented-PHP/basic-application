<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.red.min.css">

    <?= $this->section('styles') ?>
</head>

<body>
    <?= $this->insert('partials/header') ?>

    <main class="controller">
        <?= $this->section('content') ?>
    </main>

    <?= $this->insert('partials/footer') ?>
</body>

</html>