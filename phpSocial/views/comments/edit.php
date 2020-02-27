<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Profile</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <link rel="stylesheet" href="../myStyle.css">
    </head>

    <!--  php code  -->
    <!-- ********** -->
    <?php    
        session_start();
        if(!isset($_SESSION['userID']))
            header("Location:/phpSocial/views/authentication/login.php");
        $conn = mysqli_connect('localhost','root','','phpSocial');
        $userID = $_SESSION['userID'];

        $sql = "select * from comments where commentID = {$_GET['commentID']}";
        $res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        if($_POST){
            $sql = "UPDATE comments SET body='{$_POST['commentBody']}' WHERE commentID={$_POST['commentID']} ";
            $res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
            header("Location:../posts/list.php?id='{$userID}'");
        }
    ?>

    <!--  HTML code -->
    <!-- *********** -->
    <body style="background-color:#e9ebee">
    <div class="container" style="margin-top: 35px">
        <form action="" method="post">
            <div class="form-group">
                <label for="commentBody">new post</label>
                <input type="hidden" name="commentID" value="<?php echo $res['commentID'] ?>">
                <textarea class="form-control" name="commentBody" id="commentBody" cols="20" rows="5" required><?php echo $res['body'] ?></textarea>
            </div>
            <input class="btn btn-success" type="submit" value="post">
        </form>
    </div>
    </body>
</html>