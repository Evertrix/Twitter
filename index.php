<?php
session_start();

include_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">
    <link rel="stylesheet" type="text/css" href="assets/CSS/textarea.css">
    <link rel="stylesheet" href="assets/CSS/style.php" media="screen">
    <link rel = "shortcut icon" type = "image/x-icon" href = "assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Twitter</title>
</head>
<body>

<div id="container">
    <div class="full-nav">
        <div class="nav-bar">
            <div class="navigation-align">
                <nav class="nav-components">
                    <div class="twitt-logo"><img src="assets/images/twitter-icon-18-256.png"></div>
                    <br>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#explore">Explore</a></li>
                        <li><a href="#notif">Notifications</a></li>
                        <li><a href="#messages">Messages</a></li>
                        <li><a href="#bookmarks">Bookmarks</a></li>
                        <li><a href="#lists">Lists</a></li>
                        <li><a href="#profile">Profile</a></li>
                        <li><a href="#more">More</a></li>
                    </ul>
                    <br>
                </nav>
            </div>
        </div>
        <div class="tweets">
            <br>
            <?php
            $select = "SELECT * FROM tweets ORDER BY id DESC";
            $res = mysqli_query($conn, $select);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
//                    echo "<blockquote class = 'text-center'><p class='twitter-tweet'>User: " . $row['user'] . " Tweet: " . $row['tweet'] . "</p></blockquote>";


                    echo "<div class=\"tweet-wrap\">
  <div class=\"tweet-header\">
    <img src=\"https://icon-library.net/images/user-icon-image/user-icon-image-20.jpg\" style='padding-left: 10px' alt=\"\" class=\"avator\"> 
    <div class=\"tweet-header-info\">";
                    echo "<span>" . $row['user'] . "</span>";
                    echo "<p>" . $row['tweet'] . "</p>";

                    echo "</div>";
                    echo "</div>";

                    echo "<div class=\"tweet-info-counts\">
    
                        <div class=\"comments\">
                        <svg class=\"feather feather-message-circle sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><path d=\"M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z\"></path></svg>
      <div class=\"comment-count\">33</div>
                        </div>
                        
                        <div class=\"retweets\">
      <svg class=\"feather feather-repeat sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><polyline points=\"17 1 21 5 17 9\"></polyline><path d=\"M3 11V9a4 4 0 0 1 4-4h14\"></path><polyline points=\"7 23 3 19 7 15\"></polyline><path d=\"M21 13v2a4 4 0 0 1-4 4H3\"></path></svg>
      <div class=\"retweet-count\">397</div>
    </div>
    
    
    
    <div class=\"likes\">
      <svg class=\"feather feather-heart sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><path d=\"M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z\"></path></svg>
      <div class=\"likes-count\">
        2.6k
      </div>
    </div>
    
    
    <div class=\"message\">
      <svg class=\"feather feather-send sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><line x1=\"22\" y1=\"2\" x2=\"11\" y2=\"13\"></line><polygon points=\"22 2 15 22 11 13 2 9 22 2\"></polygon></svg>
    </div>
    </div>";
                    echo "</div>";

                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>
</body>
</html>