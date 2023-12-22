<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/admin/cspage.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        let currentUserId= 0;
        var jumlah_pesan = 0;
        var openchat =false;
        function setCurrentId(id){
            if(!openchat){
            currentUserId=id;
            getMessages();
            var intervalID = setInterval(function() {
               getMessages();
            }, 2000);
            document.getElementById("person" + id).style.border = "red solid 2px";
            document.getElementById("msg-container").style.visibility = 'visible';
            openchat=true;
            }else{
            document.getElementById("person" + id).style.border = "none";
            document.getElementById("msg-container").style.visibility = 'hidden';
            openchat=false;
            clearInterval(intervalID);
            }

        }
        function onClickPesan(){
        
        var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('admin/send_message') ?>';
        var params = 'id_user=' + currentUserId +'&message=' + document.getElementById("message-box").value + '&sender=bengkel' ;
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            document.getElementById("message-box").value=''
            }
            }
        http.send(params);
            
        }
        
        function getMessages() {
            var http = new XMLHttpRequest();
            var currentLocation = window.location;
            let url = '<?= base_url('admin/get_message') ?>';
            var params = 'id_user=' + currentUserId;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                var myArr = JSON.parse(this.responseText);
                myFunction(myArr);
            }
            }
            http.send(params);
        }
        function myFunction(arr) {
        var out = "";
        var i;
        
        for(i = 0; i < arr.length; i++) {
            if(arr[i].sender=='bengkel'){
                out+= '<span class="sended-text">' + '<p class="date-time">'+arr[i].time+'</p><span class="bubble-text">' + '<p>'+ arr[i].message +'</p>' +'</span></span>';
                
            }else{
                out+= '<span class="receive-text">' + '<span class="bubble-text-send">' + '<p>'+ arr[i].message +'</p>' +'</span><p class="date-time">'+arr[i].time+'</p></span>';
            }
            
        }
        document.getElementById("chat-box").innerHTML = out;
        console.log(arr.length);
        if(jumlah_pesan==arr.length){
        }else{
            element = document.getElementById('chat-box')
            element.scrollTop = element.scrollHeight
            jumlah_pesan = arr.length;
        }
        }

            // Memanggil fungsi getMessages setiap 2 detik

            
    </script>
</head>
<body>
    <div class="container">
    <h3>Selamat Datang, <?php echo session()->get('nama_bengkel_admin')?> !</h3>
        <div class=conversation-container>
        <div class='person-chat'>
        <?php 
           $user_id = array_column($user_chat, 'id_user');
           $uname = array_column($user_chat, 'nama');
           
        for($i=0;$i<count($user_id);$i++){
        ?>
        
            <div id='person<?php echo $user_id[$i]?>'onclick="setCurrentId(<?php echo $user_id[$i]?>);" class="person-receive-message">
            <i class="bi bi-person-circle"></i>
            <p><?php echo $uname[$i]?></p>
            </div>
        <?php }?>
        </div>


        <div id='msg-container'class='message-container'>
        <div id='chat-box' class='chat-box'>
            
            </div>
            <div class="send-box">
            <input id='message-box'type="text">
            
            <button onclick="onClickPesan();"> <i class="bi bi-send-fill"></i></button>
    
            </div>
            </div>
        </div>

    </div>
    
</body>
<script>
    const body = document.querySelector("body");
    const toggle = body.querySelector(".toggle");
    const nav = body.querySelector(".sidebar");
    const contents = body.querySelector(".container");
    toggle.addEventListener("click", () =>{
        nav.classList.toggle("close");
    contents.classList.toggle("close");
})

    </script>
  <!-- Sertakan library jQuery dan Bootstrap JS -->

</html>