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
        $idSql = "select userID from clients where userID = {$_GET['userID']}";
        $userID = mysqli_fetch_assoc(mysqli_query($conn,$idSql))['userID'];

        $sql = "select * from posts where postID = {$_GET['postID']}";
        $res = mysqli_fetch_assoc(mysqli_query($conn,$sql));

        if($_POST){
// echo "UPDATE posts SET body='{$_POST['postBody']}' WHERE postID={$_POST['pID']} ";
            $sql = "UPDATE posts SET body='{$_POST['postBody']}' WHERE postID={$_POST['pID']} ";
            $res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
    

            header("Location:./list.php?id='{$_GET['userID']}'");
        }
    ?>

    <!--  HTML code -->
    <!-- *********** -->
    <body style="background-color:#e9ebee">
    <div class="container" style="margin-top: 35px">
        <form action="" method="post">
            <div class="form-group">
                <label for="postBody">new post</label>
                <input type="hidden" name="uID" value="<?php echo $userID ?>">
                <input type="hidden" name="pID" value="<?php echo $res['postID'] ?>">
                <textarea class="form-control" name="postBody" id="postBody" cols="20" rows="5" required><?php echo $res['body'] ?></textarea>
            </div>
            <input class="btn btn-success" type="submit" value="post">
        </form>
    </div>
    </body>
</html>