<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/chat.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        
        function onClickPesan(){
            
        var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('admin/sendOrderMessage') ?>';
        var params = 'order_id=<?php echo $id_order?>'+ '&message=' + document.getElementById("message-box").value + '&sender=0' ;
        http.open('POST', url, true);
        
        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            location.href = window.location.href;
        }
        }
        http.send(params);
            
        }
        function myFunction(arr) {
        var out = "";
        var i;
        
        for(i = 0; i < arr.length; i++) {
            if(arr[i].sender=='0'){
                out+= '<span class="sended-text">' + '<p class="date-time">'+arr[i].waktu+'</p><span class="bubble-text">' + '<p>'+ arr[i].message +'</p>' +'</span></span>';
            }else{
                out+= '<span class="receive-text">' + '<span class="bubble-text-send">' + '<p>'+ arr[i].message +'</p>' +'</span><p class="date-time">'+arr[i].waktu+'</p></span>';
            }

            
        }
        document.getElementById("chat-box").innerHTML = out;
        }
        function getMessages() {
            var xmlhttp = new XMLHttpRequest();
            let url = '<?= base_url('admin/getOrderMessage')?><?php echo "?order_id=".$id_order?>';

            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                myFunction(myArr);
                
            }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
        getMessages();
        
        function scroll(){
    element = document.getElementById('chat-box')
        element.scrollTop = element.scrollHeight
        }
            // Memanggil fungsi getMessages setiap 2 detik
            setInterval(function() {
               getMessages();
            }, 2000);
            
    </script>
    
</head>
<body>
    <div class="container">
    <span class=back-btn>
    <a href= <?= base_url('service/dashboard')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h3>Customer Service</h3>
        <div id='chat-box' class='chat-box'>
            
        </div>
        <div class="send-box">
        <input id='message-box'type="text">
        
        <button onclick="onClickPesan();"> <i class="bi bi-send-fill"></i></button>

        </div>
    </div>

</body>

</html>