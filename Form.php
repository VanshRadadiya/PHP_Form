<?php

$conn = mysqli_connect('localhost', 'root', '', 'php');

if(isset($_GET['d_id'])){
    $id = $_GET['d_id'];
    $delete = "DELETE FROM form WHERE srno = $id";
    mysqli_query($conn, $delete);
    header('location:Form.php');
}

if(isset($_GET['u_id'])){
    $u_id = $_GET['u_id'];
    $select_single = "select * FROM form WHERE srno = $u_id";
    $u_data = mysqli_query($conn, $select_single);
    $u_row = mysqli_fetch_assoc($u_data);
    $arr_hobby = explode(',',$u_row['hobby']);
}

if (isset($_POST['save'])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $contact = $_POST["contact"];
    $city = $_POST["city"];
    $gender = $_POST["gender"];
    $hobby = implode(',', $_POST['hobby']);

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $path = "image/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    } else {
        $image = isset($u_row['image']) ? $u_row['image'] : '';
    }

    if(isset($_GET['u_id'])){
        $query = "update form set name = '$name' , email = '$email' , password = '$password' , contact = '$contact' , city = '$city' , gender = '$gender' , hobby = '$hobby' , image = '$image' where srno = '$u_id' ";
    }else{

        $query = "INSERT INTO form (name, email, password, contact, gender, city, hobby, image) VALUES ('$name', '$email', '$password', '$contact', '$gender', '$city', '$hobby', '$image')";
    }
    mysqli_query($conn, $query);
    header('location:Form.php');
}

$select = "SELECT * FROM form";
$result = mysqli_query($conn, $select);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get_Post_Method</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-secondary fw-bold" href="#">Navbar</a>
            <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="/PHP/Form/Form.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled text-light" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Form -->
    <div class="container">
        <form class="row g-3 my-5" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo @$u_row['name'] ?>" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo @$u_row['email'] ?>" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" value="<?php echo @$u_row['password'] ?>" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Contact</label>
                <input type="number" name="contact" value="<?php echo @$u_row['contact'] ?>" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">City</label>
                <select id="inputState"  name="city" class="form-select">
                    <option selected>Choose...</option>
                    <option value="Surat" <?php if(@$u_row['city']=="Surat") { echo "selected"; } ?>>Surat</option>
                    <option value="Vadodara" <?php if(@$u_row['city']=="Vadodara") { echo "selected"; } ?>>Vadodara</option>
                    <option value="Rajkoty" <?php if(@$u_row['city']=="Rajkot") { echo "selected"; } ?>>Rajkot</option>
                </select>
            </div>
            <fieldset class="col-md-4">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" <?php if(@$u_row['gender']=='male') { echo "checked"; } ?>>
                        <label class="form-check-label" for="gridRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" <?php if(@$u_row['gender']=='female') { echo "checked"; } ?>>
                        <label class="form-check-label" for="gridRadios2">
                            Female
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="col-md-4">
                 <legend class="col-form-label col-sm-2 pt-0">Hobby</legend>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Cricket"  <?php if(isset($_GET['u_id'])) { if(in_array("Cricket",@$arr_hobby)) { echo "checked"; } }?> id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Cricket
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Volleyball" 
                    <?php if(isset($_GET['u_id'])) { if(in_array("Volleyball",@$arr_hobby)) { echo "checked"; } }?> id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Volleyball
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Reading" 
                    <?php if(isset($_GET['u_id'])) { if(in_array("Reading",@$arr_hobby)) { echo "checked"; } }?> id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Reading
                    </label>
                </div>
            </div>

            <div class="col-md-4">
                <label for="inputImage" class="form-label">Image</label>
                <input type="file" name="image" value="<?php echo $u_row['image'] ?>" class="form-control" id="inputImage">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="save">Submit</button>
            </div>
        </form>

        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobby</th>
                    <th scope="col">City</th>
                    <th scope="col">Image</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['srno']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['hobby']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><img src="image/<?php echo $row['image']; ?>" width="100px" height="100px"></td>
                        <td><a href="Form.php?u_id=<?php echo $row['srno']; ?>" class="btn btn-primary">Update</a></td>
                        <td><a href="Form.php?d_id=<?php echo $row['srno']; ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
