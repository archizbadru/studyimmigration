<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.css">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/css/'?>chat.css">  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- firebase -->
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>  
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-analytics.js"></script>  
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-firestore.js"></script>

</head>
<body style="background-color: unset;">
<div id="center-text">   
</div> 
<div id="body"> 
  
<div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="material-icons">message</i>
  </div>
  
  <div class="chat-box">
    <div class="chat-box-header">
      ChatBot
      <span class="chat-box-toggle"><i class="material-icons">close</i></span>
    </div>
    <div class="chat-box-body">
      <div class="chat-box-overlay">   
      </div>
      <div class="chat-logs">
        <div class="card">
          <div class="text-center" style="padding: 8px;">Please tell your identity</div><br>          
          <div class="card-body" style="padding: 8px;">             
            <form action="<?=base_url().'chat/submit_identity/'.$comp_id.'/'.$created_by?>" id='chat_identity_form' method='post'>
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" placeholder="Full Name" value="<?=!empty($this->session->chat_fullname)?$this->session->chat_fullname:''?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="mobile" class="col-sm-2 col-form-label col-form-label-sm">Mobile</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control " id="mobile" placeholder="Mobile No." value="<?=!empty($this->session->chat_mobile)?$this->session->chat_mobile:''?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control " id="email" placeholder="Email Id" value="<?=!empty($this->session->chat_email)?$this->session->chat_email:''?>">
                </div>
              </div>
              <div class="text-center">
                <?php
                if (empty($this->session->chat_mobile)) { ?>
                  <button class="btn btn-primary" id="submit-form" type="submit">Send</button>
                  <?php
                }
                ?>
              </div>
            </form>          
          </div>
        </div>
      </div><!--chat-log -->
    </div>
    <div class="chat-input">      
      <form>
        <input type="hidden" id="agent_id" value="154">
        <input type="text" id="chat-input" placeholder="Send a message..."/>
      <button type="submit" class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>
      </form> 
    </div>
  </div>      
</div>
<script type="text/javascript">

  $("#chat_identity_form").on('submit',function(e){
    e.preventDefault();    
    var name  = $("#name").val();
    var mobile= $("#mobile").val();
    var email = $("#email").val();
    var url  = $(this).attr('action');
    if (name && email && mobile) {
      $.ajax({
         type: "POST",
         url: url,
         data: {
          name:name,
          mobile:mobile,
          email:email
         },
         beforeSend: function() {                   
         },
         success: function(data){
          
            if (data) {
              data = JSON.parse(data);
              add_user(data);  
              $("#submit-form").html('Thank You');
              $("#submit-form").prop('disabled', true);              
              // generate_message('We have accepted your details.We will reach you soon.', 'user',"<?=date('Y-m-d h:i:sa')?>");
            }else{
              alert('Something went wrong!');
            }
         }
      });
    }
  });


  var INDEX = 0; 
  $("#chat-submit").click(function(e) {
    e.preventDefault();
    var msg = $("#chat-input").val(); 
    if(msg.trim() == ''){
      return false;
    }
    //generate_message(msg, 'self');
    send_message(msg);
    /*setTimeout(function() {      
      generate_message(msg, 'user');  
    }, 1000)*/
    
  })
  
  function generate_message(msg, type,time) {
    INDEX++;
    var str="";
    str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg "+type+"\">";
    str += "          <span class=\"msg-avatar\">";
    str += "            <img src='https://github.com/ortichon.png'>";
    str += "          <\/span>";
    str += "          <div class=\"cm-msg-text\">";
    str += msg;
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-"+INDEX).hide().fadeIn(300);
    if(type == 'self'){
     $("#chat-input").val(''); 
    }    
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);    
  }  
  
  function generate_button_message(msg, buttons){    
    
    INDEX++;
    var btn_obj = buttons.map(function(button) {
       return  "              <li class=\"button\"><a href=\"javascript:;\" class=\"btn btn-primary chat-btn\" chat-value=\""+button.value+"\">"+button.name+"<\/a><\/li>";
    }).join('');
    var str="";
    str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
    str += "          <span class=\"msg-avatar\">";
    str += "            <img src='https://github.com/ortichon.png'>";
    str += "          <\/span>";
    str += "          <div class=\"cm-msg-text\">";
    str += msg;
    str += "          <\/div>";
    str += "          <div class=\"cm-msg-button\">";
    str += "            <ul>";   
    str += btn_obj;
    str += "            <\/ul>";
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-"+INDEX).hide().fadeIn(300);   
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
    $("#chat-input").attr("disabled", true);
  }
  
  $(document).delegate(".chat-btn", "click", function() {
    var value = $(this).attr("chat-value");
    var name = $(this).html();
    $("#chat-input").attr("disabled", false);
    generate_message(name, 'self');
  })
  
  $("#chat-circle").click(function() {    
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  
  $(".chat-box-toggle").click(function() {
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  
</script>
<?php
if (!empty($this->session->chat_mobile)) {
  ?>
  <script type="text/javascript">
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
    //generate_message('Hi '+"<?=$this->session->fullname?>", 'user');
  </script>
  <?php
}
?>
<script>   

    var firebaseConfig = {
      apiKey: 'AIzaSyARZpwl0KKW6AUZvRxopOJH1ZBG6ms6j8o',
      authDomain: 'new-crm-f6355.firebaseapp.com',
      projectId: 'new-crm-f6355'
    };    
    firebase.initializeApp(firebaseConfig);
    var db = firebase.firestore();
    

    function add_user(data){ 
      datetime = "<?=date('Y-m-d h:i:sa')?>";                     
      //user = "<?=$this->session->user_id?>";
      user = data.user_id;
      fullname = data.fullname;
      companey_id = data.companey_id;   


      db.collection("users").doc(user).set({
          name:fullname,
          comp_id:companey_id,
          uid:user,
          type:"enquiry",
          time:datetime
      },{merge: true})
      .then(function(docRef) {
        location.reload();
      })
      .catch(function(error) {
          console.error("Error adding document: ", error);
      });
   generate_message('We have accepted your details.We will reach you soon.', 'user',"<?=date('Y-m-d h:i:sa')?>");
    }

    function makeid(length) {
      var result           = '';
      var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;
      for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      return result;
    }
    function send_message(msg){
          $.ajax({
          url: "<?=base_url().'chat/get_current_date_time'?>",
          type:"POST",
          success: function(data){            
            var agent_id = $("#agent_id").val();      
            datetime = data; 
            timstmp = new Date().getTime();                       
            unq_id = "<?=$this->session->chat_user_id?>"+'_'+timstmp+'_'+makeid(5);     
            db.collection("messages").doc(unq_id).set({
                id:"<?=$this->session->chat_user_id?>"+"_"+agent_id,
                time: datetime,
                message: msg,
                sender_id: "<?=$this->session->chat_user_id?>",
                receiver_id: agent_id,
                comp_id:"<?=$this->session->chat_companey_id?>",
                unread:1,          
                created_at:firebase.firestore.FieldValue.serverTimestamp(),
                unq_id:unq_id
            })
            .then(function(docRef) {                
                $("#chat-input").val('');                 
            })
            .catch(function(error) {
                console.error("Error adding document: ", error);
            });
          }
      });
    } 
    comp_id = "<?=$this->session->chat_companey_id?>"
    user_id = "<?=$this->session->chat_user_id?>"
    const msg = db.collection('messages').orderBy('created_at').where('comp_id','==',comp_id);
    const msg_observer = msg.onSnapshot(docSnapshot => {          
        docSnapshot.docChanges().forEach(change => {                  
            console.log(docSnapshot.docChanges());
          if (change.type === 'added') {
            msg1_data = change.doc.data(); 
            uid = msg1_data.receiver_id;      
            if (isNaN(msg1_data.sender_id) && msg1_data.sender_id == "<?=$this->session->chat_user_id?>") {
              uid = msg1_data.sender_id;
              generate_message(msg1_data.message, 'self',msg1_data.time);
            }else if (!isNaN(msg1_data.sender_id) && msg1_data.receiver_id == "<?=$this->session->chat_user_id?>") {
              generate_message(msg1_data.message, 'user',msg1_data.time);              
            }                           
          }
        });
    });     
</script>

</body>
</html>
