<?php
    
    if($_POST){   
        session_start();
        $conn = mysqli_connect("localhost","root","","phpSocial");
        // Check connection
        if($conn){
            echo "connected <br>";
        }elseif ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        }
        if(isset($_POST['register'])){
            if($_POST["Password1"] == $_POST["Password2"] ){

                $image = $_FILES['image']['name'];
                $target = "../images/".$image;
                
                $res =mysqli_query($conn,"INSERT INTO clients (userName, email, Password , image) VALUES (
                    '{$_POST['userName']}', 
                    '{$_POST['email']}', 
                    '{$_POST['Password1']}',
                    '$image')");
                if($res){
                    move_uploaded_file($_FILES['image']['tmp_name'], $target);
                    $_SESSION["userID"] = $conn->insert_id;
                    mysqli_close($conn);
                    header("Location:../views/posts/list.php?id='{$_SESSION['userID']}'");

                }else {
                    mysqli_close($conn);
                    header("Location:../views/authentication/register.php");
                }
            }
        }elseif(isset($_POST['login'])){
            
            $res = mysqli_query($conn,"SELECT * FROM clients WHERE userName='{$_POST['userName']}'");
            if($res){
                $data = $res->fetch_assoc();
                // echo $data['userID'];
                if($_POST['Password'] == $data['Password']){
                    mysqli_close($conn);
                    $_SESSION["userID"] = $data['userID'];
                    header("Location:../views/posts/list.php");
                }
                else{
                    mysqli_close($conn);
                    header("Location:../views/authentication/login.php");
                }
            }else{
                mysqli_close($conn);
                header("Location:../views/authentication/login.php");
            }
        }
    }else{
        header("Location:/phpSocial/views/authentication/login.php");
    }
?>