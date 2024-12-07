<?php include('pdb.php')?>


<?php
if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        echo 'Name is required <br>';
    }else{
        $name = $_POST['name'];
    }
    if(empty($_POST['model'])){
        echo 'Model is required <br>';
    }else{
        $model = $_POST['model'];
    }
    if(empty($_POST['description'])){
        echo 'Description is required <br>';
    }else{
        $description = $_POST['description'];
    }
    if(empty($_POST['characteristics'])){
        echo 'Charcteristics is required <br>';
    }else{
        $characteristics = $_POST['characteristics'];
    }
    if(empty($_POST['price'])){
        echo 'Price is required <br>';
    }else{
        $price = $_POST['price'];
    }
    

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $model = mysqli_real_escape_string($con, $_POST['model']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $characteristics = mysqli_real_escape_string($con, $_POST['characteristics']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $sql = "INSERT INTO product_table(part_name,part_model,part_desc,part_characteristics,part_price) VALUES('$name', '$model', '$description', '$characteristics', '$price')";

    if(mysqli_query($con, $sql)){
    echo 'successfull submit';
    }else{
        echo 'querry_error: ' . mysqli_error($con);
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <h4>Add a part</h4>
        <form action="admin_add_to_db.php" method ="POST">
            <label for="">Add part name</label>
            <input type="text"  class="login-input" name="name"><br>
            <label for="">Add part model</label>
            <input type="text"  class="login-input" name="model"><br>
            <label for="">Add part description</label>
            <input type="text" class="login-input characteristics" name="description"><br>
            <label for="">Add part characteristics</label>
            <input type="text"  class="login-input" name="characteristics"><br>
            <label for="">Add part price</label>
            <input type="text"  class="login-input" name="price"><br>
            <div>
                <input type="submit" class="login-button" name="submit" value="submit">
            </div>
        </form>
    </section>
</body>
</html>