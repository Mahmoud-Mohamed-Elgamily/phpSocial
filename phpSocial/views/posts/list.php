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
    $userquery = "select * from clients where userID = {$userID}";
    $userData = mysqli_fetch_assoc(mysqli_query($conn,$userquery));
    $userName = $userData['userName'];
    $userImage = $userData['image'];
    $postsQuery = "
        SELECT
            p.postID,
            p.body,
            p.image as Pimage,
            c.userID,
            c.userName,
            c.image
        FROM
            `posts` AS p
        INNER JOIN `clients` AS c
        ON
            p.userID = c.userID
        ORDER BY p.postID DESC
    ";    
    $res = mysqli_query($conn,$postsQuery);
?>



<!--  HTML code -->
<!-- *********** -->
<body style="background-color:#e9ebee">
    <div class='container'>
        <div class="row" style="display: flex;">
            <div class="col-md-10">
            <h1 style='display:block;margin:15px auto'> 
                <img class="media-object photo-profile" src="../../images/<?php echo $userImage; ?>">
                welcome <?php echo $userName ?> 
            </h1>
            </div>
            <div class="col-md-2" style="align-self: center;">
                <a href="/phpSocial/controller/logOut.php" class="btn btn-danger">Log Out</a>
            </div>
        </div>

        <form id="postForm" action="/phpSocial/controller/postController.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="postBody">new post</label>
                <input type="hidden" name="uID" value="<?php echo $userID ?>">
                <textarea class="form-control" name="postBody" id="postBody" cols="20" rows="10"></textarea>
            </div>
            <input type="file" name="postImage">
            <input class="btn btn-success" type="submit">
        </form>

        <?php

            if(!($res->num_rows == 0))
            while($data = mysqli_fetch_assoc($res)){
        ?>
        <div style="width: 40%;margin: 20px auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <section class="post-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="media" style="background-color: #b3ccd4;">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object photo-profile"
                                            src="../../images/<?php echo $data['image']; ?>">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="anchor-username">
                                            <h4 class="media-heading">
                                                <?php echo $data['userName']; ?>
                                            </h4>
                                        </a>
                                    </div>

                                    <?php 
                                        if($userID == $data['userID'])
                                        echo '
                                        <div class="media-right">
                                            <a class="btn btn-danger" href="/phpSocial/controller/postController.php?idDelete='.$data['postID'].'&userID='.$data['userID'].'"> Delete </a>    
                                            <a class="btn btn-info" href="/phpSocial/views/posts/edit.php?postID='.$data['postID'].'&userID='.$data['userID'].'"> Edit </a>
                                        </div>';
                                        
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="post-body">
                    <?php if($data['body']){ ?>    
                        <p>
                            <pre>   <?php echo $data['body']; ?></pre>
                        </p>
                    <?php }?>
                        <?php if($data['Pimage']){ ?>
                            <img src="../../images/<?php echo $data['Pimage'] ?>" class="postImage">
                        <?php } ?>
                    </section>
                    <section class="post-footer">
                        <hr>
                        <div class="post-footer-option container" style="width:100%">
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Like</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-comment"></i> Comment</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-share-alt"></i> Share</a></li>
                            </ul>
                        </div>
                        <div class="post-footer-comment-wrapper">
                            <div class="comment">
                                <div class="addComment">
                                    <form action="../../controller/commentController.php" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="post" value="<?php echo $data['postID'] ?>">
                                            <textarea placeholder="comment" class="form-control" name="commentBody" cols="20" rows="2" required></textarea>
                                        </div>
                                        <input class="btn btn-success" type="submit" value="post">
                                    </form>
                                </div>
                                <?php 
                                    $commentQuery ='
                                    SELECT
                                        cl.userName,
                                        cl.image,
                                        co.commentID,
                                        co.body,
                                        co.userID
                                    FROM
                                        `clients` AS cl INNER JOIN
                                        `comments` AS co
                                    ON
                                        co.userID = cl.userID AND
                                        co.postID = '.$data['postID'].'
                                        ORDER BY co.commentID DESC
                                    ';
                                    #'.$data['userID'].'
                                    #'.$data['postID'].'
                                    $comments = mysqli_query($conn , $commentQuery);
                                    while($comment = mysqli_fetch_assoc($comments)){
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object photo-profile"
                                            src="../../images/<?php echo $comment['image']; ?>" width="32" height="32" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="anchor-username">
                                            <h4 class="media-heading">
                                                <?php echo $comment['userName']; ?>
                                            </h4>
                                        </a>
                                        <form action="" method="post">
                                            <p> <?php echo $comment['body']; ?> </p>
                                        </form>
                                    </div>
                                    <?php 
                                        if($userID == $comment['userID'])
                                        echo '
                                        <div class="media-right">
                                            <a class="btn btn-danger" href="/phpSocial/controller/commentController.php?idDelete='.$comment['commentID'].'"> Delete </a>    
                                            <a class="btn btn-info" href="/phpSocial/views/comments/edit.php?commentID='.$comment['commentID'].'"> Edit </a>
                                        </div>';  
                                    ?>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <hr>
        </div>
        <?php
                }
            else
                echo "<h1 id='noPosts' >enter some posts to start ?</h1> ";
    ?>
    </div>
</body>

</html>