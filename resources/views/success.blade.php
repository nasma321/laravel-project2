<!DOCTYPE html>
<html>
 <head>
  <title>Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Laravel</h3><br />

   @if(isset(Auth::user()->email))
    <div class="alert alert-success success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <br />
     <a href="{{ url('/main/logout') }}">Logout</a>
     <br>
     <select name="apps" id="apps">
        <option value="">Please Select</option>
        <option value="1">Project 2</option>
     </select>
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif
   
   <br />
  </div>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#apps').on('click', function(){
        if($('#apps').val() == 1){
            $.ajax({
               type:'POST',
               url:'/main/project2login',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
        }
    })
  </script>
 </body>
</html>