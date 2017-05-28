<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 5/14/2017
 * Time: 5:06 PM
 */
?>
<html>
<head>
    <title>ATC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .radar {
            width: 100%;
            height: 100%;
            background-color: black;
        }
        .command-bar {
            padding: 15px;
        }
    </style>
</head>
<body>
<div class="radar">
    <div class="plane" style="position: absolute;">
        <img src="http://www.atc-sim.com/images/blip.gif" alt="">
    </div>
</div>
<div class="command-bar">
    test
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        interval = 1000;
        plane = $(".plane");
        getdata();
    });
    function move(plane) {
        //alert(position.left);
        //get data
        var div = plane;
        $.ajax({
            type:"POST",
            url: "http://localhost/projects/index.php/atc/get_plane_data",
            datatype: "json",
            success:function(res){
                console.log(res);
            },
            error:function(){
                console.log("error");
            }
        });
        //calculate data
        var spd_x = 2;  
        var spd_y = 2;
        var position = plane.position();
        var pos_x = position.left;
        var pos_y = position.top;

        plane.css({ left : pos_x + spd_x});
        plane.css({ top : pos_y + spd_y});
    }
    function getdata() {
        setTimeout(function(){
            move(plane);
        }, interval);
    }
</script>