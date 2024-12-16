<?php

require_once('vendor/connect.php');
session_start();

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

} else {

    header('Location: /sign-in.html');
}

$cars = mysqli_query($connect, "SELECT * FROM `cars`");
$cars = mysqli_fetch_all($cars);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Autopark</title>
</head>
<body>

    <header>

        <input id="search" type="search" placeholder="Search...">

        <div class="btn-holder">

            <?php

            if ($_SESSION['full-access']) {

                print <<<_HTML_
                    <button id="toggle-button">Add car</button>
                _HTML_;
            }

            ?>

            <a href="vendor/log-out.php" class="button">Log out</a>

            <div id="userid" class="container">
                <p>user id: <?php echo $user_id?></p>
            </div>
            
        </div>

    </header>


    <main>

        <div class="overlay hidden" id="overlay">
            <div class="invisible_holder">

                <div class="form_header">

                    <h2>Add car</h2>
                    <button id="close-button">Close</button>

                </div>

                <form style="width: 100%" action="vendor/database-append.php" method="post" enctype="multipart/form-data">

                    <div class="form-item">
                        <label for="brand">Brand</label>
                        <input name="brand" id="brand" type="text" required>
                    </div>

                    <div class="form-item">
                        <label for="model">Model</label>
                        <input name="model" id="model" type="text" required>
                    </div>

                    <div class="form-item">
                        <label for="color">Color</label>
                        <input name="color" id="color" type="text" required>
                    </div>

                    <div class="form-item">
                        <label for="condition">Condition</label>
                        <input name="condition" id="condition" type="text">
                    </div>

                    <div class="form-item">
                        <label for="maintenance-date">Maintenance date</label>
                        <input name="maintenance-date" id="maintenance-date" type="date" required>
                    </div>

                    <div class="form-item">
                        <label for="fuel-consumption">Fuel consumption</label>
                        <input name="fuel-consumption" id="fuel-consumption" type="text" required>
                    </div>

                    <div class="form-item">
                        <label for="photo">Photo</label>

                        <div class="file-upload">
                            <span class="file-name">No file selected</span>
                            <input name="file-input" id="file-input" type="file" class="file-input"  required/>
                            <label for="file-input" class="file-label">Upload Photo</label>
                        </div>
                    </div>

                    <button id="form-submit" type="submit">Submit</button>

                </form>
            </div>
        </div>

        <?php

        foreach ($cars as $car) {

            $date = new \DateTime($car[5]);
            $date = $date -> format('d.m.Y');

            print <<<_HTML_
                <div class="plate">

                    <div class="plate-overlay hidden">
                        <div class="container">
                            <p>Delete car?</p>

                            <button class="btn-yes">Yes</button>
                            <button class="btn-no">No</button>
                        </div>
                    </div>

                    <img src="img/$car[7]" class="plate-image">

                    <p class="plate-header">$car[1] $car[2]</p>

                    <table class="plate-info">

                        <tr>
                            <td><p class="parameter">ID</p></td>
                            <td><p class="value">$car[0]</p></td>
                        </tr>
                        <tr>
                            <td><p class="parameter">Color</p></td>
                            <td><p class="value">$car[3]</p></td>
                        </tr>
                        <tr>
                            <td><p class="parameter">Maintenance date</p></td>
                            <td><p class="value">$date</p></td>
                        </tr>
                        <tr>
                            <td><p class="parameter">Fuel consumption</p></td>
                            <td><p class="value">$car[6] / 100</p></td>
                        </tr>

                    </table>
                </div>
            _HTML_;
        }

        ?>

    </main>
    
</body>
<?php

if ($_SESSION['full-access']) {

    print <<<_HTML_
        <script src="script/add-car.js"></script>
        <script src="script/delete-car.js"></script>
    _HTML_;
}

?>
<script src="script/script.js"></script>
</html>