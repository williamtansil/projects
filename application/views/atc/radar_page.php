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
            width: 1000px;
            height: 700px;
            /*margin: 0 auto;*/
            background-color: black;
        }
        .command-bar {
            padding: 15px;
        }
        .plane-attr{
            color: white;
            z-index: 2;
        }
        .plane {
            background-image: url('http://www.atc-sim.com/images/blip.gif');
            width: 10px; height: 10px;
            background-position: -20px -30px;
        }
    </style>
</head>
<body>
<div class="radar">
    
</div>
<div class="command-bar">
    <input type="text" name="command_bar" id="command-bar">
    <button onclick="generate_command($('#command-bar').val())">broadcast</button>
</div>
</body>
</html>
<script>
    interval=1000;
    $(document).ready(function(){
        plane=$(".plane");
        //getdata();
    });
    function generate_command(cmd) {
        //cmd contain id cmd param1, param2
        var result=cmd.split(" ");
        var next_data=[];
        $.ajax({
            url:"get_command_data/"+result[1],
            datatype:"json",
            success:function(res_cmd){
                console.log(res_cmd);
                if(res_cmd!=null && res_cmd.length > 0) {
                    res_cmd = JSON.parse(res_cmd);
                    next_operation = {flight_callsign:result[0], command_param:res_cmd.command_param, change_spd:res_cmd.change_spd, 
                        command_target:result[2]};
                    //update target in plane data
                    $.ajax({
                        type:'post',
                        datatype:'json',
                        url:'put_plane_data/'+result[0],
                        data:next_operation,
                        success:function(res_plane){
                            console.log(res_plane);
                        }
                    });
                } else {
                    alert('invalid command');
                }
                // console.log(next_operation);
                // generate_data(next_operation);
                return next_operation;
            },
            error:function(){
                console.log('error to generate command');
            }
        });
    }

    function add() {
        new_plane={

        }
        $.ajax({
            url:"add_plane",
            datatype:json,
            data:new_plane,
            error:function(){
                console.log("error to add plane");
            }
        });
    }

    function del(flight_callsign) {
        $.ajax({
            url:"del_plane/"+flight_callsign,
            error:function(){
                console.log("error to delete plane");
            }
        });
    }

    function move(planes) {
        //put to database
        $.each(planes,function(i,plane){
            var pxps = (((parseFloat(plane.speed)*1.852)*(10/8))/3600);
            new_data = {
                //calculate plane data
                callsign:plane.flight_callsign,
                pxps_x:pxps*(Math.cos(parseInt(plane.heading)*(Math.PI/180))),
                pxps_y:pxps*(Math.sin(parseInt(plane.heading)*(Math.PI/180))),
                alt:(parseFloat(plane.altitude) + 
                    ((parseFloat(plane.altitude)==parseFloat(plane.target_alt))?
                        0:parseFloat(plane.vertical_spd))),
                hdg:(parseInt(plane.heading) + 
                    ((parseFloat(plane.heading)==parseFloat(plane.target_hdg))?
                        0:parseFloat(plane.turn_spd))),
                x:(parseFloat(plane.x) + parseFloat(plane.pxps_x)),
                y:(parseFloat(plane.y) - parseFloat(plane.pxps_y))
            }
            new_data.hdg = (new_data.hdg < 0) ? 360 : new_data.hdg;
            new_data.hdg = (new_data.hdg > 360) ? 0 : new_data.hdg;

            console.log(new_data);
            console.log('turning : '+!(parseFloat(plane.heading)==parseFloat(plane.target_hdg)));
            console.log('sin : '+Math.sin(parseInt(plane.heading)*(Math.PI/180)));
            console.log('cos : '+Math.cos(parseInt(plane.heading)*(Math.PI/180)));
            $.ajax({
                type:"POST",
                url:"put_plane_data/"+plane.flight_callsign,
                datatype:"json",
                data:new_data,
                success:function(res){
                    console.log(res);
                },
                error:function(){
                    console.log("error to put plane data");
                }
            });
        });
    }

    function frame() {
        now_command = $('#command-bar').val();
        past_command = "";
        $('.radar').html("");
        //get from database
        $.ajax({
            url:"get_planes_data",
            datatype:"json",
            success:function(res){
                //generate animation
                var res = JSON.parse(res);
                $.each(res, function(i,plane){
                    var obj="<div class='plane-attr' style='position:absolute;width:200px;left:"+plane.x+"px;top:"+(plane.y-30)+"px'>"+
                                "<span class='id'><b>"+plane.flight_callsign+"</b></span> "+
                                "<span class='spd'><small>spd:"+plane.speed+"</small></span> "+
                                "<span class='hdg'><small>hdg:"+plane.heading+"</small></span> "+
                                "<span class='alt'><small>alt:"+plane.altitude+"</small></span> "+
                            "</div>"+
                            "<div class='plane' style='position:absolute;left:"+plane.x+"px;top:"+plane.y+"px;'>";
                    $('.radar').append(obj);
                });
                //generate next move
                move(res);
            },
            error:function(){
                console.log("error to get plane data");
            }
        });
    }
    frame();
    // setInterval(frame, interval);
    
</script>