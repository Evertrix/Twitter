<?php
session_start();

include_once('db.php');

// check if user is logged in if not redirect to login.php

$make_a_tweet = $_POST['tweet'];
$make_image = $_POST['the_file'];
define ('MAX_FILE_SIZE', 1000000);
$permitted = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'text/plain');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}

// check if a tweet has been submitted if not just show the form

if (isset($_POST["tweet"]) && !empty($_POST["tweet"])) {
    $sql = "INSERT INTO tweets (user_id, user, tweet, image) VALUES ('{$_SESSION['user_id']}', '{$_SESSION['username']}', '$make_a_tweet', '{$_FILES['the_file']['name']}')";



}
$abs_upload_path = __DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR  . "uploads" . DIRECTORY_SEPARATOR ;

if ($_FILES['the_file']['size'] > 0 && $_FILES['the_file']['size'] <= MAX_FILE_SIZE) {
    if ($_FILES['the_file']['error'] == 0) {
        move_uploaded_file($_FILES["the_file"]["tmp_name"], $abs_upload_path . $_FILES["the_file"]["name"]);

        if(in_array($_FILES['the_file']['type'], $permitted)) {

            echo '<img src="assets/uploads/'.$_FILES["the_file"]["name"].'">';
        }
        elseif($filetype == "text")
        {
            echo nl2br( file_get_contents("assets/uploads/".$_FILES["the_file"]["name"]) );
        }

    } else {
        echo "Not permitted filetype.";
    }
}

if (mysqli_query($conn, $sql) == true) {
    header("Location: dashboard.php");
    die();
}


// if a tweet has been submitted the save it in the database an then show the form


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>

        function gotkey() {
            var count = document.getElementById("postMessage").value.length;

            if (count > 280) {
                var output = "Sorry";
                count;
            } else {
                var output = "Character count: " + count + " of " + 280;
            }
            document.getElementById("status").innerHTML = output;
        }


    </script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Twitter</title>
</head>
<body>

<div>
    <div class="account">
        <p><?php echo "Hello, " . $_SESSION['username'] ?></p>
    </div>
</div>

<div id="container">
    <div class="full-nav">
        <div class="nav-bar">
            <div class="navigation-align">
                <nav class="nav-components">
                    <div class="twitt-logo"><img src="assets/images/twitter-icon-18-256.png"></div>
                    <br>
                    <ul>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                        <li><a href="change.php">Change Password</a></li>
                    </ul>
                    <br>

                </nav>
            </div>
        </div>

        <div class="publish">
            <form method="post" action="/dashboard.php" enctype="multipart/form-data">
                <div class="twitter boxContainer">
                    <div class="twitter boxContainer">
                        <label class="twitter tweetHeader">Compose new Tweet</label>
                        <span class="close"></span>
                        <div class="lineSplit"></div>
                        <div><textarea class="messageBox" id="postMessage" name="tweet" onkeyup="gotkey()"
                                       placeholder="What's happening?"></textarea></div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000">

                        <input name="the_file"
                               accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/quicktime" multiple=""
                               tabindex="-1" type="file" data-focusable="true">
                        <p><input type="submit"
                                  style="background-image: url(https://lh3.googleusercontent.com/CpBwweN6YgNQGK_9LRvXKI8KEEcnMORDQGXj3XazCsK_dWlp-HzUT7YF5h7gEWP1yQ48=w300)"
                                  class="post_Button" id="submit_Post" name="submit" value="Tweet"></p>
            </form>


            <label class="wordCounter" id="status"></label>
            <div aria-haspopup="false" aria-label="Add photos or video" role="button" data-focusable="true" tabindex="0"
                 class="css-18t94o4 css-1dbjc4n r-1niwhzg r-42olwf r-sdzlij r-1phboty r-rs99b7 r-1w2pmg r-1vuahiu r-mvpalk r-1imd94c r-1vuscfd r-53xb7h r-mk0yit r-o7ynqc r-6416eg r-lrvibr">
                <div dir="auto"
                     class="css-901oao r-1awozwy r-13gxpu9 r-6koalj r-18u37iz r-16y2uox r-1qd0xha r-a023e6 r-vw2c0b r-1777fci r-eljoum r-dnmrzs r-bcqeeo r-q4m81j r-qvutc0">
                    <span class="css-901oao css-16my406 css-bfa6kz r-1qd0xha r-ad9z0x r-bcqeeo r-qvutc0"></span>
                </div>
            </div>

        </div>
    </div>
    </form>
    <br>
</div>

<?php
$select = "SELECT * FROM tweets ORDER BY id DESC";
$res = mysqli_query($conn, $select);


if (mysqli_num_rows($res) > 0) {

    while ($row = mysqli_fetch_assoc($res)) {

        echo '<div class="tweet-wrap">
  <div class="tweet-header">
    <img src="https://icon-library.net/images/user-icon-image/user-icon-image-20.jpg" style="padding-left: 10px" class="avator">
    <div class="tweet-header-info">';

        echo "<div>" . $row['user'] . "<span>•</span>" . "<span>" . $row['time'] . "</span>" . "</div>";
        echo "<p>" . $row['tweet'] . "</p>";
        if ($row['image']) {
            echo '<img style="width:100px; height: 100px;" src="assets/uploads/' . $row['image'] . '">';
        }


        echo "</div>";
        echo "</div>";

        echo '<div class="tweet-info-counts">
    
                        <div class="comments">
                        <svg class="feather feather-message-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
      <div class="comment-count">33</div>
                        </div>
                        
                        <div class="retweets">
      <svg class="feather feather-repeat sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
      <div class="retweet-count">397</div>
    </div>
    
    
    
    <div class="likes">
      <svg class="heart" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
      <div class="likes-count">
       2.6k
      </div>
    </div>
    
    
    
    <div class="message">
      <svg class="feather feather-send sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
    </div>
    </div>';
        echo "</div>";
    }
}

mysqli_close($conn);
?>

</div>
</div>
</body>
</html>