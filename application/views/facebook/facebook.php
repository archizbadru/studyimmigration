<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2671840339741760',
      xfbml      : true,
      version    : 'v8.0'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function subscribeApp(page_id, page_access_token) {
    console.log('Subscribing page to app! ' + page_id);
       console.log('Subscribing page to app! ' + page_access_token);
    FB.api(
      '/' + page_id + '/subscribed_apps',
      'post',
      {access_token: page_access_token, subscribed_fields: ['leadgen']},
      function(response) {
        console.log('Successfully subscribed page', response);
      }
    );
  }
    
  // Only works after `FB.init` is called
  function myFacebookLogin() {
    FB.login(function(response){
      console.log('Successfully logged in', response);
      FB.api('/me/accounts', function(response) {
        console.log('Successfully retrieved pages', response);
        var pages = response.data;
        var ul = document.getElementById('list');
        for (var i = 0, len = pages.length; i < len; i++) {
          var page = pages[i];
          var li = document.createElement('li');
          var a = document.createElement('a');
          a.href = "#";
          a.onclick = subscribeApp.bind(this, page.id, page.access_token);
          a.innerHTML = page.name;
          li.appendChild(a);
          ul.appendChild(li);
          $.ajax({
      url : "<?=base_url('dashboard/fb_page')?>",
      type: "post",
      dataType : "json",
      data :{page_id:page.id,page_token:page.access_token},
      success : function(data)
      { }});
        }
      });
    }, {scope: 'pages_show_list'});
  }
</script>
<br>
<div class="col-md-12 text-center"><br><br>
<button onclick="myFacebookLogin()" class="btn btn-info">Get Your Leads</button>
</div>
<ul id="list"></ul>