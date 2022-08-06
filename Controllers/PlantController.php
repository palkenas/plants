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
        if (empty($_POST['namelt']) || empty($_POST['namelat'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas pavadinimas";
        }
        if (is_numeric($_POST['namelt']) || is_numeric($_POST['namelat'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Pavadinimas negali būti skaičius";
        }

        if (preg_match('/[^a-zA-ZĄČĘĖĮŠŲŪŽąčęėįšųūž_\-]/i', $_POST['namelt']) || preg_match('/[^a-zA-Z _\-]/i', $_POST['namelat'])) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Pavadinime turi būti tik raidės";
        }

        if (is_numeric($_POST['age']) == false) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Augalo amžius turi būti skaičius";
        }
        if (is_numeric($_POST['height']) == false) {
            $hasErrors = true;
            $_SESSION['errors'][] = "Augalo aukštis turi būti skaičius";
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
        if(empty($_POST['namelt'])||empty($_POST['namelat'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas pavadinimas";
        }
        if(is_numeric($_POST['namelt']) || is_numeric($_POST['namelat'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Pavadinimas negali būti skaičius";
        }

        if(preg_match('/[^a-zA-ZĄČĘĖĮŠŲŪŽąčęėįšųūž_\-]/i', $_POST['namelt']) || preg_match('/[^a-zA-Z _\-]/i', $_POST['namelat'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Pavadinime turi būti tik raidės";
        }
        
        if(is_numeric($_POST['age']) == false){
            $hasErrors = true;
            $_SESSION['errors'][] = "Augalo amžius turi būti skaičius";
        }
        if(is_numeric($_POST['height']) == false){
            $hasErrors = true;
            $_SESSION['errors'][] = "Augalo aukštis turi būti skaičius";
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
