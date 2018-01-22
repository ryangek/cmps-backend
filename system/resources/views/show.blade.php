<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div id="id"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://localhost:3000');
        var i=0;
        socket.on("my-channel:App\\Events\\EventHistory", function(msg){
            // increase the power everytime we load test route
            i++;
            console.log(msg);
            $('#id').append(msg.data.history[i].history_id+'<br>');
        });
    </script>
</body>
</html>