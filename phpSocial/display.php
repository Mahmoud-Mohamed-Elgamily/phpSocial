<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="myStyle.css">
</head>

<body style="background-color:#e9ebee">
    <div class='container'>
        <h1 style='display:block;margin:15px auto'> welcome Mahmoud</h1>

        <form action="" method="post">
            <?php    
                echo <<<start
                <input type="hidden" class="form-control" name="userName" value="Mahmoud">
                start
            ?>
            <div class="form-group">
                <label for="postBody">new post</label>
                <textarea class="form-control" name="postBody" id="postBody" cols="20" rows="5"></textarea>
            </div>
            <input class="btn btn-success" type="submit" value="post">
        </form>
        <!-- 
            <div style="width: 40%;margin: 20px auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <section class="post-heading">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object photo-profile"
                                                src="https://via.placeholder.com/150" width="40" height="40" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="anchor-username">
                                            <h4 class="media-heading">
                                                Mahmoud
                                            </h4>
                                            <a class="btn btn-danger" href="#">
                                            Delete
                                            </a>
                                            <a class="btn btn-info" href="#">
                                            Edit
                                            </a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="post-body">
                        <p>
                            <pre>
            hello this is my first day with php
            hope i will like it someday 
            till this happed with you all good luck :)
                            </pre>
                        </p>
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
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object photo-profile"
                                                src="https://via.placeholder.com/150" width="32" height="32" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="anchor-username">
                                            <h4 class="media-heading">
                                            Mahmoud
                                            </h4>
                                        </a>
                                        <form action="" method="post">
                                            <p>hello this is comment</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
         </div> 
        -->

        <?php

            $fp = fopen("posts.csv","a");
            $arr=$_POST;
            $arr[] = count(file("posts.csv"));

            if(isset($_POST['postBody']) && !empty($_POST['postBody']) ){
                fputcsv($fp,$arr);
            }
            
            fclose($fp);
            
            $fh = fopen("posts.csv", "r");
            

            while (($data = fgetcsv($fh, 1000, ","))) 
            {
                echo <<<start
                <div style="width: 40%;margin: 20px auto;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <section class="post-heading">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object photo-profile" src="https://via.placeholder.com/150" width="40" height="40" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="anchor-username">
                                                <h4 class="media-heading">
                                                    {$data[0]}
                                                </h4>
                                                <a class="btn btn-danger" href="?id={$data[2]}">
                                                    Delete
                                                </a>
                                                <a class="btn btn-info" href="{$data[2]}">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="post-body">
                                <p>
                                    <pre>
                {$data[1]}
                                    </pre>
                                </p>
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
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object photo-profile" src="https://via.placeholder.com/150" width="32"
                                                        height="32" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="anchor-username">
                                                    <h4 class="media-heading">
                                                        echo {$data[0]}
                                                    </h4>
                                                </a>
                                                <form action="" method="post">
                                                    <p>hello this is comment</p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                start;
            }

    fclose($fh);

    ?>

        <?php

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($id) {
                $file_handle = fopen("posts.csv", "w+");
                $myCsv = array();
                while (!feof($file_handle) ) {
                    $line_of_text = fgetcsv($file_handle, 1024);    
                    if ($id != $line_of_text[2]) {
                        fputcsv($file_handle, $line_of_text);
                    }
                }
                fclose($file_handle);
            }   
        }
    ?>
    </div>
</body>

</html>