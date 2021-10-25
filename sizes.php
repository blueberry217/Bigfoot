<?php

include "php/connection.php";

// start session
session_start();

// check if the user is logged in
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: login.php");
    exit();
}

// check the user has permission for sizes_view
if ($_SESSION['sizes_view'] != true) {
    header("location: index.php");
    exit();
}

// insert
if ($_SESSION['sizes_insert'] == true) {
    if (isset($_POST['add'])) {
        if (isset($_POST['name'])) {
            if ($_POST['name'] != '') {
                $name = $_POST['name'];
                $brandid = $_POST['brandid'];
                $modelid = $_POST['modelid'];
                $query = "INSERT INTO `sizes`(`id`,`brand_id`,`model_id`, `name`) VALUES (DEFAULT," .$brandid ."," .$modelid .",'" .$name ."')";
                if ($db->query($query) === true) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $query . "<br>" . $db->error;
                }
            }
        }
    }
}

// update
if ($_SESSION['sizes_update'] == true) {
    if (isset($_POST['change'])) {
        if (isset($_POST['id'])) {
            if ($_POST['id'] != '' && $_POST['name'] != '') {
                $name = $_POST['name'];
                $id = $_POST['id'];
                $query ="UPDATE `sizes` SET `name`='" .$name ."' WHERE `id` =" .$id ." ;";
                if ($db->query($query) === true) {
                    echo "record Updated successfully";
                } else {
                    echo "Error: " . $query . "<br>" . $db->error;
                }
            }
        }
    }
}

// remove
if ($_SESSION['sizes_remove'] == true) {
    if (isset($_GET['removeid'])) {
        if ($_GET['removeid'] != '') {
            $id = $_GET['removeid'];
            $query = "DELETE FROM `sizes` WHERE `id` =" . $id . " ;";
            if ($db->query($query) === true) {
                echo "record Removed successfully";
            } else {
                echo "Error: " . $query . "<br>" . $db->error;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sizes</title>
</head>
<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
    }
</style>

<body>
<a href="logout.php">Logout</a>
    <hr>

  <div>
      <?php

      // check on roles what permissions are checked
      if ($_SESSION['brand_view'] == true) {
          echo '<a href="brands.php">Brands  </a>';
      }

      if ($_SESSION['models_view'] == true) {
          echo '<a href="models.php">Models  </a>';
      }

      if ($_SESSION['sizes_view'] == true) {
          echo '<a href="sizes.php">Sizes  </a>';
      }
      
      ?>
  </div>
    <h1>sizes Page</h1>
    <div class='grid-container'>
        <div>
            <table border='1px'>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <?php if ($_SESSION['sizes_remove'] == true) { ?>
                    <th>Remove</th>
                    <?php } ?>
                    <?php if ($_SESSION['sizes_update'] == true) { ?>
                    <th>Change</th>
                    <?php } ?>
                </tr>

                <?php
                require_once "php/connection.php";
                $query = "select * from sizes ;";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td> ';
                        if ($_SESSION['sizes_update'] == true) {
                            echo '<td><a href="sizes.php?id=' .$row['id'] .'&name=' .$row['name'] .'">Change</a></td>';
                        }
                        if ($_SESSION['sizes_remove'] == true) {
                            echo '<td><a href="sizes.php?removeid=' .$row['id'] .'">remove</a></td>';
                        }
                    }
                }
                ?>
            
            </table>

        </div>
        <?php if ($_SESSION['sizes_insert'] == true) { ?>
        <div>
            <h2>Add New sizes</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="">Select Brand:</label>
                <select name="brandid" id="">
                <?php
                require_once "php/connection.php";
                $query = "select * from brands ;";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] .'">' .$row['name'] .'</option>';
                    }
                }
                ?>
                </select>
                <br>
                <label for="">Select Model:</label>
                <select name="modelid" id="">

                <?php
                require_once "php/connection.php";
                $query = "select * from models ;";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {echo '<option value="' .$row['id'] .'">' . $row['name'] .'</option>';
                    }
                }

                ?>
                </select>
                <br>

                <label for="">Name:</label>
                <input type="text" name="name" id="">
                <button type="submit" name="add">Add</button>
            </form>
        </div>
        <?php } ?>

        <?php if ($_SESSION['sizes_update'] == true) { ?>
            
        <div>
            <h2>Change then edit add a size</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="">ID:</label>
            <input readonly type="text" name="id" value="<?php if (isset($_GET['id'])) { echo $_GET['id'];} ?>" id="">
            <label for="">New Name:</label>
            <input type="text" name="name"value="<?php if (isset($_GET['name'])) {echo $_GET['name'];} ?>" id="">
            <button type="submit" name="change">change</button>
        </form>
    </div>
    <?php } ?>
    </div>
   

</body>

</html>