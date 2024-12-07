<?php
  include("productsv1.1/pdb.php");
  include("loginshit/auth_session.php");
?>
<?php
  $sql='SELECT  part_name,part_characteristics,part_price,part_model,part_id FROM product_table'; 
  $result = mysqli_query($con, $sql);
  $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if(isset($_POST['asc'])){
    $sql='SELECT  part_name,part_characteristics,part_price,part_model,part_id FROM product_table ORDER BY part_price ASC'; 
    $result = mysqli_query($con, $sql);
    $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  if(isset($_POST['desc'])){
    $sql='SELECT  part_name,part_characteristics,part_price,part_model,part_id FROM product_table ORDER BY part_price DESC';
    $result = mysqli_query($con, $sql);
    $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  // $sqll ='SELECT username from users';
  // $resultl = mysqli_query($conn, $sqll) or die( mysqli_error($conn));
  // $user = mysqli_fetch_all($resultl, MYSQLI_ASSOC);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<div id="container">
    <div class="header_nav" id="header-nav">
        <h1 class="main" >MS Computer parts</h1>
        <button class="btnnav"><a href="indexloggedin.php">Home Page</a></button>
        <button class="btnnav"><a href="index.php">Logout</a></button>
        <p class="ptext">You are logged in as <span><?php echo $_SESSION['username']?></span></p>
    </div>      
    <div class="filters">
    <div id="filter_byType">
      <div class="dropdown">
        <button class="dropbtn btnbrand">Sort by brand</button>
        <div class="dropdown-content">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <button class="btn" onclick="filterSelection('Asus')">Asus</button>
            <button class="btn" onclick="filterSelection('ASRock')">ASRock</button>
            <button class="btn" onclick="filterSelection('EVGA')">EVGA</button>
        </div>
      </div>
    </div>
    <div id="filter_byPrice">
        <div class="dropdown">
          <button class="dropbtn btnprice">Sort by price</button>
          <div class="dropdown-content">
              <button class="btn active"> Show all</button>
              <form action="index.php" method="POST">
              <button class="btn" name="asc" value="asc"> Ascending</button>
              <button class="btn" name="desc" value="desc"> Descending</button>
              </form>
            </div>
        </div>
      </div>
     </div>
    <div class="parts-container">
    <?php foreach ($parts as $part){?>    
      <div class="<?php echo htmlspecialchars($part['part_model'])?> filterDiv parts">
      <a href="product_pageloggedin.php?id=<?php echo $part['part_id'] ?>" class="part_link">  
      <img src="product_images/<?php echo htmlspecialchars($part['part_name'])?>.png">
      <h2><?php echo htmlspecialchars($part['part_name']) ?></h2>
      <ul>
        <?php foreach(explode(',', $part['part_characteristics']) as $pchar){ ?>
        <li><?php echo htmlspecialchars($pchar); ?></li>
        <?php } ?>
      </ul>  
        <h3><?php echo htmlspecialchars($part['part_price']) ?>lv</h3>
        </a>
        </div>
        <?php } ?>
      </div> 
      <?php include("footer.php");?>
</div>
<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

// Show filtered elements
function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}
</script>
</body>
</html>