<!-- header("Location:../views/posts/list.php") -->

<?php
    // session check
    session_start();
    if(!isset($_SESSION['userID']))
        header("Location:/phpSocial/views/authentication/login.php");
    // DB CONNECTION
    $conn = mysqli_connect('localhost','root','','phpSocial');
    // ADDING NEW POST
    if($_POST){

        $image = $_FILES['postImage']['name'];
        $target = "../images/".$image;
        
        var_dump($_POST);

        if( !($_POST['postBody'] != "" || $image) )
            header("Location:../views/posts/list.php?id='{$_POST['uID']}'");
        else{
            $query = "INSERT INTO posts (body , image , userID) VALUES ('{$_POST['postBody']}','$image','{$_POST['uID']}')";
            echo $query;
            $res = mysqli_query($conn , $query);
            if($res){
                move_uploaded_file($_FILES['postImage']['tmp_name'], $target);
                mysqli_close($conn);
                header("Location:../views/posts/list.php?id='{$_POST['uID']}'");
            }
            else
            var_dump($res);
        }
    // DELETING POST
    } elseif (isset($_GET['idDelete'])) {
        $sql = "DELETE FROM posts WHERE postID={$_GET['idDelete']}";
        $res = mysqli_query($conn , $sql);
        mysqli_close($conn);
        header("Location:../views/posts/list.php?id='{$_GET['userID']}'");
    }
    mysqli_close($conn);
?>