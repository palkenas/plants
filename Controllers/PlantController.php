<?php
include './Models/Plant.php';
class PlantController {

    public static function index() {
        $plants = Plant ::all();
        return $plants;
    }

    public static function show(){
        $plant = Plant::find($_POST['id']);
        return $plant;
    }

    public static function update()
    {
        session_start();
        $hasErrors = false;
        if (empty($_POST['namelt'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas lietuviškas pavadinimas";
        }
        if (empty($_POST['namelat'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas lotyniškas pavadinimas";
        }

        if (empty($_POST['age'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas augalo maksimalus amžius";
        }
        if (empty($_POST['height'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas augalo maksimalus aukštis";
        }
        if (strlen($_POST['namelt']) > 20) {
            $_SESSION['errors'][] = "Lietuviškas pavadinimas negali būti ilgesnis nei 20 simbolių";
            $hasErrors = true;
        }
        if (strlen($_POST['namelat']) > 30) {
            $_SESSION['errors'][] = "Lotyniškas pavadinimas negali būti ilgesnis nei 30 simbolių";
            $hasErrors = true;
        }
        if (strlen($_POST['age']) > 10) {
            $_SESSION['errors'][] = "Augalo amžius negali būti ilgesnis nei 10 simbolių";
            $hasErrors = true;
        }
        if (strlen($_POST['height']) > 10) {
            $_SESSION['errors'][] = "Augalo aukštis negali būti ilgesnis nei 10 simbolių";
            $hasErrors = true;
        }
        if ($hasErrors) {
            return true;
        } else {
            Plant::update();
            return false;
        }
        
    }

    public static function destroy()
    {
        Plant::destroy();
    }


    public static function store()
    {
        session_start();
        $hasErrors = false;
        if(empty($_POST['namelt'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas lietuviškas pavadinimas";
        }
        if(empty($_POST['namelat'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas lotyniškas pavadinimas";
        }   
        
        if(empty($_POST['age'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas augalo maksimalus amžius";
        }
        if(empty($_POST['height'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas augalo maksimalus aukštis";
        }
        if(strlen($_POST['namelt']) > 20){
            $_SESSION['errors'][] = "Lietuviškas pavadinimas negali būti ilgesnis nei 20 simbolių";
            $hasErrors = true;
        }
        if(strlen($_POST['namelat']) > 30){
            $_SESSION['errors'][] = "Lotyniškas pavadinimas negali būti ilgesnis nei 30 simbolių";
            $hasErrors = true;
        }
        if(strlen($_POST['age']) > 10){
            $_SESSION['errors'][] = "Augalo amžius negali būti ilgesnis nei 10 simbolių";
            $hasErrors = true;
        }
        if (strlen($_POST['height']) > 10) {
            $_SESSION['errors'][] = "Augalo aukštis negali būti ilgesnis nei 10 simbolių";
            $hasErrors = true;
        }
        if($hasErrors){
            return true;
        } else {
        Plant ::create();
        return false;
        }
    }
}
