<?php
// Cleaned and organized kategoriak.php
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriak - PcZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-light bg-white shadow-sm px-4 py-2">
    <div>
        <a href="../kontaktua" class="btn btn-primary">Kontaktua</a>
    </div>
    <div class="ms-auto d-flex gap-4 fs-4">
        <a href="../hasiera/index.php" class="text-dark text-decoration-none">🏠</a>
        <a href="#" class="text-dark text-decoration-none">👤</a>
    </div>
</nav>

<div class="text-center mt-4">
    <h1 class="display-4 fw-bold">Kategoriak</h1>
</div>

<div class="container mt-3">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../hasiera/index.php">Hasiera</a></li>
            <li class="breadcrumb-item active">Kategoriak</li>
        </ol>
    </nav>
</div>

<hr class="w-50 mx-auto">

<div class="container py-4">

<?php if ($dbError): ?>
    <p class="text-danger text-center"><?php echo htmlspecialchars($dbError); ?></p>

<?php elseif (!empty($kategoriak)): ?>

    <div class="row g-4 justify-content-center">
        <?php foreach ($kategoriak as $kategoria): ?>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="../hasiera/img/kategoria<?php echo htmlspecialchars($kategoria->getId()); ?>.png"
                     class="card-img-top" alt="Irudia">

                <div class="card-body text-center">
                    <h3 class="fw-bold"><?php echo htmlspecialchars($kategoria->getIzena()); ?></h3>

                    <p class="text-muted small"><?php echo htmlspecialchars($kategoria->getLaburpena()); ?></p>

                    <a href="index.php?id_kategoria=<?php echo $kategoria->getId(); ?>"
                       class="btn btn-primary">Ikusi Produktuak</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p class="text-center">Ez dago kategoriarik.</p>
<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

