<?php
// Making Connection with DataBase.
require 'Dbconnect.php'; // File which contain PHP code to connect with DataBase.
?>

<?php
// Declaring Variable for alert - Default value is False.
$insert = false;
$update = false;
$delete = false;
?>

<?php
if (isset($_GET['delete'])){
    $sno = $_GET['delete'];
    // Delete Notes
    $sql = "DELETE FROM `contactus` WHERE `SNo` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $delete = true;
    }
    else{
        echo "Soory! We are facing some Techniqal issue to delete your Record.";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update Note

        $SNo = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];

        $sql = "UPDATE `contactus` SET `Title` = '$title' , `Description` = '$desc' WHERE `contactus`.`SNo` = $SNo";

        $result = mysqli_query($conn, $sql);
        if ($result) {
           $update = true;
        } else {
            echo "No Updation! We Facing some Techniqal issue.";
        }
        

    } else {
        //Insert Note
        $title = $_POST['title'];
        $desc = $_POST['desc'];

        $sql = "INSERT INTO `contactus` (`Title`, `Description`) VALUES ('$title', '$desc')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Soory!</strong> Unable to Saved Note. We are Facing some Technical Error.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyNotes - Save Your Notes Here !</title>
    <!-- Including bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Including Style css Sheet -->
    <link rel="stylesheet" href="style.css">
    <!-- Including Jquery DataTable css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body style="background-color: #000000f0 white">

    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/php/NotesTakingApp/index.php" method="post">
                        <div class="mb-3">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <label for="title" class="form-label">Edit Titile</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Edit Description</label>
                            <textarea class="form-control" name="descEdit" id="descEdit" cols="30" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 mt-2">Update Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Making Navigation Bar -->
    <nav class="navbar navbar-expand-lg " style="background-color:#000000fa">
        <div class="container-fluid d-flex justify-content-between">
            <div class="logo">
                <a class="navbar-brand" href="index.php">MyNotes</a>
            </div>
            <div class="collapse navbar-collapse mx-5 d" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link mx-2" aria-current="page" href="#">About</a>
                    <a class="nav-link" href="#">Contact</a>
                    <a class="nav-link mx-2" href="#">Pricing</a>
                    <a class="nav-link">Term & Condition</a>
                </div>
            </div>
            <div class="touch">
                <button type="button" class="btn btn-outline-secondary">Newsletter</button>
                <button type="button" class="btn btn-outline-secondary">Follow Us</button>
            </div>
            <div class="hamburger">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>

    <?php
    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Note has been Saved Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Note has been Updated Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if ($delete) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Note has been deleted Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }


    ?>

    <!-- Creating Form For user Input -->
    <div class="container px-5 my-3 mb-4" width="20">
        <h3>Add Your Note</h3>
        <form action="/php/NotesTakingApp/index.php" method="post">
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Note Titile -</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Note Description -</label>
                <textarea class="form-control" name="desc" id="desc" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-lg btn-primary my-2">Add Note</button>
        </form>
    </div>
    <hr>
    <div class="conatiner my-4 px-5">
        <table class="table my-2" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Printing All Records.
                $sql = "SELECT * FROM `contactus`";
                $result = mysqli_query($conn, $sql);
                $Sno = 0;
                while ($rows = mysqli_fetch_assoc($result)) {
                    $Sno++;
                    echo "<tr>
                    <th scope='row'>" . $Sno . "</th>
                    <td>" . $rows['Title'] . "</td>
                    <td>" . $rows['Description'] . "</td>
                    <td><button type='button' class='Edit btn btn-success' data-bs-toggle='modal' data-bs-target='#EditModal' id=" . $rows['SNo'] . ">Edit</button> <button type='button' id=d". $rows['SNo'] ." class='Delete btn btn-danger'>Delete</button>
                    </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <!-- Including bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <!-- Including Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- Including Jquery DataTable js -->
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Including DataTable js Function -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        // Event Listener for Edit Note
        Edits = document.getElementsByClassName('Edit');
        Array.from(Edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                console.log("Edit",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                description = tr.getElementsByTagName('td')[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
            })
        })

        // Event Listener for Delete Note
        Delete = document.getElementsByClassName('Delete');
        Array.from(Delete).forEach((elements) =>{
            elements.addEventListener('click', (e) =>{
                console.log("Delete", );
                tr = e.target.parentNode.parentNode;
                sno = e.target.id.substr(1,);

                if (confirm("Are you Sure! You Want to Delete this Note!")) {
                    console.log("Yes");
                    window.location = `/php/NotesTakingApp/index.php?delete= ${sno}`;
                } else {
                    console.log("No");
                }
            })
        })

    </script>
</body>

</html>