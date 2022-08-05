<?php
include './controllers/PlantController.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['save'])) {
        $hasErrors = PlantController::store();
        if (!$hasErrors) {
            header("Location:" . $_SERVER['REQUEST_URI']);
        }
    }
    if (isset($_POST['edit'])) {
        $plant = PlantController::show();
    }
    if (isset($_POST['update'])) {
        PlantController::update();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
    if (isset($_POST['destroy'])) {
        PlantController::destroy();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
}
$plants = PlantController::index();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/reset.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/main.css">
    <title>Plants</title>
</head>

<body>

    <div class="container">
        <?php if (isset($_SESSION) && isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) { ?>
                <div class="alert alert-danger" role="allert">
                    <?= $error; ?>
                </div>
        <?php  }
            unset($_SESSION['errors']);
        }
        ?>
        <div id="title">
            Augalų enciklopedija
        </div>
        <div id="form">
            <form id="form" class="form-inline" action="" method="post">
                <div class="form-row">
                    <div id="input1" class="form-group col-md-4">
                        <label for="name">Lietuviškas augalo pavadinimas</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Įveskite lietuvišką pavadinimą" <?= isset($_POST['edit']) ? 'value="' . $plant->name . '"' : '' ?>>
                    </div>
                    <div id="input2" class="form-group col-md-4">
                        <label for="nomen">Lotyniškas augalo pavainimas</label>
                        <input type="text" class="form-control" id="nomen" name="nomen" placeholder="Įveskite lotynišką pavadinimą" <?= isset($_POST['edit']) ? 'value="' . $plant->nomen . '"' : '' ?>>
                    </div>
                    <div id="input3" class="form-group col-md-4">
                        <label for="perennial">Daugiametis</label>
                        <input type="radio" class="form-check-input" id="radio" name="perennial" value="1" checked <?= isset($_POST['edit']) ? 'value="' . $plant->perennial . '"' : '' ?>>
                        <label for="perennial">Vienmetis</label>
                        <input type="radio" class="form-check-input" id="radio" name="perennial" value="0" <?= isset($_POST['edit']) ? 'value="' . $plant->perennial . '"' : '' ?>>
                    </div>
                    <div id="input4" class="form-group col-md-4">
                        <label for="age">Maksimalus augalo amžius</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="Įveskite maksimalų augalo amžių" <?= isset($_POST['edit']) ? 'value="' . $plant->age . '"' : '' ?>>
                    </div>
                    <div id="input5" class="form-group col-md-4">
                        <label for="height">Maksimalus augalo aukštis</label>
                        <input type="text" class="form-control" id="height" name="height" placeholder="Įveskite maksimalų augalo aukštį" <?= isset($_POST['edit']) ? 'value="' . $plant->height . '"' : '' ?>>
                    </div>
                    <?= isset($_POST['edit']) ? '<input type="hidden" name="id" value="' . $plant->id . '">' : "" ?>
                    <button id="btn" class="btn btn-outline-dark" type="submit" name=<?= isset($_POST['edit']) ? '"update" > Atnaujinti' : '"save" > Išsaugoti' ?> </button>
            </form>
        </div>
    </div>


    <div class="container">
        <div id="scroll" class="table-responsive">
            <table id="table" class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">Lietuviškas augalo pavadinimas</th>
                        <th scope="col">Lotyniškas augalo pavadinimas</th>
                        <th scope="col">Daugiametis/Vienmetis</th>
                        <th scope="col">Maksimalus augalo amžius</th>
                        <th scope="col">Maksimalus augalo aukštis</th>
                        <th scope="col">Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plants as $plant) { ?>
                        <tr>
                            <td><?= $plant->name ?></td>
                            <td><?= $plant->nomen ?></td>
                            <td><?= $plant->perennial ? "augalas daugiametis" : "augalas vienmetis" ?></td>
                            <td><?= $plant->age ?></td>
                            <td><?= $plant->height ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $plant->id ?>">
                                    <button id="edit" class="btn btn-outline-warning" type="submit" name="edit">Redaguoti</button>
                                </form>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $plant->id ?>">
                                    <button id="delete" class="btn btn-outline-danger" type="submit" name="destroy">Ištrinti</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>

</html>