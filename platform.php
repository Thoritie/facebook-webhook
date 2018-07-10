<h2> My platform </h2>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '431139364026381',
      xfbml      : true,
      version    : 'v3.0'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  function get_lead(form_id, page_access_token){
    FB.api(
      '/' + form_id + '/leads',
      'get',
      {access_token: page_access_token},
      function(response) {
        console.log('leads_data', response );
      });

  }

  function get_list_of_form(page_id, page_access_token){
    FB.api(
      '/' + page_id + '/leadgen_forms',
      'get',
      {access_token: page_access_token},
      function(response) {

        var lead_forms = response.data;
        var ul = document.getElementById('lead_forms')

        for(var i = 0, len = lead_forms.length; i < len; i++) {
          var lead_form = lead_forms[i];
          var li = document.createElement('li');
          var a = document.createElement('a');

          a.href = "#";
          a.onclick = get_lead.bind(this, lead_form.id, page_access_token);
          a.innerHTML = lead_form.name;

          li.appendChild(a);
          ul.appendChild(li);

        }
        console.log('lead_form', response );
      });

  }
  function subscribeApp(page_id, page_access_token) {
    console.log('Subscribing page to app! ' + page_id);
    FB.api(
      '/' + page_id + '/subscribed_apps',
      'post',
      {access_token: page_access_token},
      function(response) {
      console.log('Successfully subscribed page', response);
    });
  }

  // Only works after `FB.init` is called
  function myPage() {
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
          a.onclick = get_list_of_form.bind(this, page.id, page.access_token);
          a.innerHTML = page.name;
        
          li.appendChild(a);
          ul.appendChild(li);
        }
      });
    }, {scope: 'manage_pages'});
  }
</script>

<button onclick="myPage()">Get page</button>
<ul id="list">

</ul>

<ul id="lead_forms"></ul>
