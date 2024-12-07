<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  
  $id = $_GET['id'];
  
  try {
    $conn = new PDO("mysql:host=$servername;dbname=product_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM product_table WHERE part_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();    
    
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="productpagestyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div id="header-nav">
        <h1 class="main" >MS Computer parts</h1>
        <button class="btnnav"><a href="index.php">Home Page</a></button>
        <button class="btnnav"><a href="loginshit/login.php">Login</a></button>
        <p class="ptext">You are logged in as a <span>guest</span></p>
    </div>      
<div class="container">
      <?php
        foreach ($data as $row => $part) { ?>
        <h1 class="partname"><?php echo $part['part_name']?></h1>
        <div class="pricechar">
        <h3><?php echo ($part['part_price']) ?>lv</h3><br>
        <ul>
        <?php foreach(explode(',', $part['part_characteristics']) as $pchar){ ?>
        <li><?php echo htmlspecialchars($pchar); ?></li>
        <?php } ?>
        </ul>
        <button class="openButton openBtn" id="buybtn" onclick="openForm()">Buy</button>
          
      </div>
        <div class="overlay"> 
        <div class="formPopup" id="popupForm">
            <form onsubmit="return false;" class="formContainer">
              <h1>Поръчка</h1>

              <label for="name"><b>Имена</b></label>
              <input type="text" id="input" placeholder="Въведете 3те имена" name="name" required>

              <label for="number"><b>Номер</b></label>
              <input type="text" id="input" placeholder="Въведете номер на телефон" name="number" required>

              <label for="adress"><b>Адрес</b></label>
              <input type="text" id="input" placeholder="Въведете адрес за доставка" name="adress" required>

              <button type="submit" class="btn" id="submit">Поръчка</button>
              <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
          </div>
          </div>

        <img src="product_images/<?php echo ($part['part_name'])?>.png">
        
        <p><?php echo ($part['part_desc']) ?></p>
      <?php } ?>
      </div>
      <?php include("footer.php");?>

</div>

<script>

function openForm() {
  document.getElementById("popupForm").style.display = "block";
}

function closeForm() {
  document.getElementById("popupForm").style.display = "none";
}
document.getElementById("submit").addEventListener("click", function(){
  document.getElementById("popupForm").style.display = "none";
  alert("Поръчката е пратена"); 
   
  });

</script>
</body>
</html>