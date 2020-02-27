<?php
    session_start();
    if(!isset($_SESSION['userID']))
        header("Location:/phpSocial/views/authentication/login.php");
    $conn = mysqli_connect('localhost','root','','phpSocial');
    $userID = $_SESSION['userID'];
    // var_dump($_POST);
    if($_POST){    
            $commentQuery = 'INSERT INTO comments 
            (body, postID, userID) 
            VALUES 
            ("'.$_POST['commentBody'].'",'.$_POST['post'].','.$userID.')
        ';
        $res = mysqli_query($conn,$commentQuery);
        var_dump($res);
        mysqli_close($conn);
        header('Location:../views/posts/list.php');
    } elseif(isset($_GET['idDelete'])){
        $sql = "DELETE FROM comments WHERE commentID={$_GET['idDelete']}";
        $res = mysqli_query($conn , $sql);
        mysqli_close($conn);
        header("Location:../views/posts/list.php?id='{$_GET['userID']}'");
    }
    
?>