<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel | Home</title>

         <!-- Bootstrap for "rtl" -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Styles -->
        


        <!-- Scripts -->
        @vite(['resources/js/_for-chat/app.js'])


        <!-- chat body Styles -->
        @vite(['resources/css/_welcome/style.css'])

    </head>
    <body >
    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                @if (Route::has('login'))

                    @auth
                        <a href="{{ url('/profile') }}" class="">{{trans('in.Profile')}}</a>
                        <!-- <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ trans('in.LogOut') }}</a> -->
                    @else
                        <a href="{{ route('login') }}" class="">{{trans('in.Log-in')}}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">{{trans('in.Register')}}</a>
                        @endif
                    @endauth

                @endif
    </div>
    <span style="font-size:30px;cursor:pointer" id="tlist" class="m-3" onclick="openNav()">&#9776; </span>


    <!-- <div class="container"> --> <div class="conn">
      <!-- <div class="chat-header">

        <div class="title"></div>
      </div> -->
      <div class="chat-body">

      <!-- {{trans('in.hi')}} -->
      <div class="help">
        <div>
<div id="elem" class="row">
  <div id="val" class="col-lg-3 col-md-12">{{trans('in.hi')}}</div>
  <div id="val" class="col-lg-3 col-md-12" >{{trans('in.hi')}}</div>
  <div id="val" class="col-lg-3 col-md-12">{{trans('in.hi')}}</div>
  <div id="val" class="col-lg-3 col-md-12">{{trans('in.hi')}}</div>
  <div id="val" class="col-lg-3 col-md-12">{{trans('in.hi')}}</div>
  <div id="val" class="col-lg-3 col-md-12">{{trans('in.hi')}}</div>
  </div>
      </div>
    </div>
      
    
    
    
    </div>
      <div class="chat-input">
        <div class="input-sec ">
          <input type="text" id="txtInput" placeholder="  .....اكتب هنا" autofocus />
        </div>
        <div class="send">
          <!-- <img src="resources/_images/send.svg" alt="send" /> -->
          <button type="button" class="btn  ml-4" id="bt" > <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"  fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
            </svg>
            </button>

        </div></div>
      <!-- </div> -->










    <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
    </body>
</html>
