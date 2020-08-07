<html>
<head>
    <title> Employee Homepage</title>
    <meta charset="UTF-8">
    <!--Bootstrap 4 css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="float-left">
  <div class="container">
    <div class="col">
      <div class="row-md-4 offset-md-4 form-div2 login">
      <form action="query1.php" method="post">
        <h3 class="text-center" style="Color:Black">Insert Product</h3>
        <div class="form-group">
            <button type="submit" name="select-btn" class="btn btn-primary btn-block btn-lg">Select</button>

        </div>

      </form>
      </div>

      <div class="row-md-4 offset-md-4 form-div2 login">
      <form action="query2.php" method="post">
        <h3 class="text-center" style="Color:Black">Update Dependent Name</h3>
        <div class="form-group">
            <button type="submit" name="select-btn" class="btn btn-primary btn-block btn-lg">Select</button>

        </div>

      </form>
      </div>

      <div class="row-md-4 offset-md-4 form-div2 login">
      <form action="query4.php" method="post">
        <h3 class="text-center" style="Color:Black">Delete Product</h3>
        <div class="form-group">
            <button type="submit" name="select-btn" class="btn btn-primary btn-block btn-lg">Select</button>

        </div>

      </form>
      </div>

    </div>
  </div>

</div>

<div class="main">
<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "turnit";
// Create connection
$conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $dbusername, $dbpassword);
// Check connection
if (!$conn)
{
    die("Connection failed");
}

else
{
    $query1 = "SELECT ptype
    FROM `product`
    Group By ptype";
    // "SELECT ptype FROM `Product Group By ptype"
    if($stmt = $conn->prepare("SELECT ptype FROM `product` Group By ptype"))
    {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array = array();
        foreach ($rows as $row)
        {
            $type = $row["ptype"];
            $query = "SELECT * from `product` where ptype='$type'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            array_push($array, $products);
        }
        foreach ($array as $a)
        {
            echo nl2br(" \n ");
            echo nl2br(" \n ");
            echo "<div class='proType'>".$a[0]['ptype']."</div>";
            echo '<table>';
            echo '<tr class="heading">';
            echo "<th>productid</th>";
            echo "<th>pname</th>";
            echo "<th>color</th>";
            echo "<th>size</th>";
            echo "<th>baseprice</th>";
            echo '</tr>';
            foreach ($a as $b)
            {
                echo '<tr>';
                echo "<td>".$b['productid']."</td>";
                echo "<td>".$b['pname']."</td>";
                echo "<td>".$b['color']."</td>";
                echo "<td>".$b['size']."</td>";
                echo "<td>".$b['baseprice']."</td>";
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}
?>
</div>
</body>
</html>
