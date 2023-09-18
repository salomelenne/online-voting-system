<?php
/*include('connect.php');
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$adress=$_POST['adress'];
$image=$FILES['photo']['name'];
$tmp_name=$FILES['photo']['tmp_name'];
$role=$_POST['role'];

if ($password==$cpassword){
move_uploaded_file($tmp_name,"../uploads/$image");
$insert=mysqli_query($connect,"INSERT INTO user(name,mobile,password,adress,photo,role,status,votes) 
values('$name','$mobile','$password','$adress','$image','$role',0,0)");
if($insert){
    echo '
    <script>
    alert("registration successfully");
    window.location="../";
    </script>
    
    ';
}else{
    echo '
    <script>
    alert("some error occured!");
    window.location="../routes/register.html";
    </script>
    
    ';
}
}else{
    echo '
    <script>
    alert("password and confirm password does not match");
    window.location="../routes/register.html";
    </script>
    
    ';
}*/


session_start();
include('connect.php');

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$adress = $_POST['adress'];
$role = $_POST['role'];

// Check if passwords match
if ($password != $cpassword) {
    echo '<script>
            alert("Password and Confirm Password do not match");
            window.location="../routes/register.html";
          </script>';
    exit();
}

// File Upload
if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $upload_dir = "../uploads/";

    // Validate file type (you may want to add more checks here)
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        echo '<script>
                alert("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
                window.location="../routes/register.html";
              </script>';
        exit();
    }

    // Rename the file to avoid conflicts
    $new_filename = uniqid('user_photo_', true) . '.' . $file_extension;
    $target_path = $upload_dir . $new_filename;

    if (move_uploaded_file($tmp_name, $target_path)) {
        // Insert user data into the database with plain text password
        $insert = mysqli_query($connect, "INSERT INTO user(name, mobile, password, adress, photo, role, status, votes) 
                                           VALUES ('$name', '$mobile', '$password', '$adress', '$new_filename', '$role', 0, 0)");
        if ($insert) {
            echo '<script>
                    alert("Registration successful");
                    window.location="../";
                  </script>';
        } else {
            echo '<script>
                    alert("Some error occurred while registering. Please try again.");
                    window.location="../routes/register.html";
                  </script>';
        }
    } else {
        echo '<script>
                alert("Failed to upload the photo. Please try again.");
                window.location="../routes/register.html";
              </script>';
    }
} else {
    echo '<script>
            alert("Error uploading photo. Please try again.");
            window.location="../routes/register.html";
          </script>';
}
?>


