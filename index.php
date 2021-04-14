<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "activity_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "INSERT INTO activity (name, description, category, activity_date)
  VALUES ('".$_POST['title']."', '".$_POST['description']."', '".$_POST['category']."','".$_POST['date']."')";
  echo $sql;



  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    unset($_POST);
    header("Location: ".$_SERVER[REQUEST_URI]);
  exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="lib/css/bootstrap.css">
	<title>My Activities</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Activity</a>
        <a class="nav-link" href="#">Contact</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-4">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="col">
          <div class="mb-3">
            <label class="form-label">Activity Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Morning Ride">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
             <input type="text" class="form-control" id="category" name="category" placeholder="Cycling">
          </div>
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-dark float-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-8">
      <div class="container">
        <div class="row" >
          <div class="col-1 border bg-light"><b>Id</b></div>
          <div class="col-3 border bg-light"><b>Title</b></div>
          <div class="col-3 border bg-light"><b>Activity</b></div>
          <div class="col-2 border bg-light"><b>Date</b></div>
          <div class="col-3 border bg-light"><b>Actions</b></div>
        </div>
      </div>
      <div class="container">
<?php
      $sql = "SELECT id, name, description, category, activity_date FROM activity order by id desc";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
?>
        <div class="row" >
          <div class="col-1 border bg-light"><?= $row["id"] ?></div>
          <div class="col-3 border bg-light"><?= $row["description"] ?></div>
          <div class="col-3 border bg-light"><?= $row["category"] ?></div>
          <div class="col-2 border bg-light"><?= $row["activity_date"] ?></div>
          <div class="col-3 border bg-light"><a href='update_product.php?id={$id}' class='btn btn-info'> Edit </a> <a delete-id='{$id}' class='btn btn-danger'>Delete</a></div>
        </div>
<?php
        }
      } else {
?>
        <div class="row" >
            <div class="col alert alert-danger">No activities. Please add.</div>
        </div>
<?php 
      }
?>
      </div>
    </div>
  </div>
</div>
</body>
</html>