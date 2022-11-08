<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{--  CSS  --}}
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     
     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
    @yield('css')
    @yield('script')

    <script src="{{ asset('js/layout.js') }}"></script>
</head>
<body>
    @if (session('role') == 'SA')
            {{--  Start Navigation Bar  --}}
        <div class="col-12 fixed-top menu">
            <div class="menu-label">
                <div class="icon1 mx-3">
                    <button class="btn clickicon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">  <i class="fa-solid fa-bars icons" ></i></button>
                  
                </div>
                <div class="label mx-2">
                    Membership Management
                </div>

                <div class="icon2 mx-3">
                <a href="/sale"> <i class="fa-solid fa-plus iconborder"></i></a>
                    <p class="sale">Quick Sales</p>
                </div>
            </div>
            

            <div class="account">
                <p class="admin">{{ session('name') }}</p>
                <a href="/logout">
                    <i class="fa-solid fa-power-off icons"></i>
                </a>
            </div>

        </div>
        
        {{-- Start Side Bar --}}
        <div class="container-fluid">
            <div class="row">
                    <div id="sidebar" class="col-lg-2 col-md-2 col-sm-2 sides on">
                       
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item dh "> <a href="/dashboard" class="nav-link dh">Dashboard</a> </li>
                                <li class="small">Insight</li>
                                <li class="nav-item ana"><a href="/analytics" class="nav-link ana">Analytics</a></li>
                                <li class="small">sales</li>
                                <li class="nav-item sal"><a href="/sale" class="nav-link sal">Sales</a></li>
                                <li class="nav-item cu"><a href="/customer" class="nav-link cu">Customer</a></li>
                                <li class="small">report</li>
                                <li class="nav-item ex"><a href="/export" class="nav-link ex">Export</a></li>
                                <li class="small">management</li>
                                <li class="nav-item me"><a href="/membership" class="nav-link me">Membership</a></li>
                                <li class="nav-item se"><a href="/setting" class="nav-link se">Setting</a></li>
                            </ul>
                        </div>
    @elseif(session('role') == 'OP')
                        {{--  Start Navigation Bar  --}}
        <div class="col-12 fixed-top menu">
            <div class="menu-label">
                <div class="icon1 mx-3">
                    <i class="fa-solid fa-bars icons" ></i>
                </div>
                <div class="label mx-2">
                    Membership Managment
                </div>

                <div class="icon2 mx-3">
                <a href="/sale"> <i class="fa-solid fa-plus iconborder"></i></a>
                    <p class="sale">Quick Sales</p>
                </div>
            </div>
            

            <div class="account">
                <p class="admin">{{ session('name') }}</p>
                <a href="/logout">
                    <i class="fa-solid fa-power-off icons"></i>
                </a>
            </div>

        </div>
        
        {{-- Start Side Bar --}}
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-2 col-md-2  sides on">
                       
                            <ul class="nav nav-pills flex-column mb-auto">
                                {{-- <li class="nav-item dh "> <a href="/dashboard" class="nav-link dh">Dashboard</a> </li> -}}
                                 <li class="small">Insight</li>  
                                <li class="nav-item ana"><a href="/analytics" class="nav-link ana">Analytics</a></li>  --}}
                                 <li class="small">Insight</li> 
                                <li class="nav-item ana"><a href="/analytics" class="nav-link ana">Analytics</a></li>  
                                <li class="small">sales</li>
                                <li class="nav-item sal"><a href="/sale" class="nav-link sal">Sales</a></li>
                                <li class="nav-item cu"><a href="/customer" class="nav-link cu">Customer</a></li>
                                <li class="small">report</li>
                                <li class="nav-item ex"><a href="/export" class="nav-link ex">Export</a></li>
                                <li class="small">management</li>
                                {{--  <li class="nav-item me"><a href="/membership" class="nav-link me">Membership</a></li>  --}}
                                <li class="nav-item se"><a href="/setting" class="nav-link se">Setting</a></li>
                                {{-- <li class="nav-item se"><a href="/setting" class="nav-link se">Setting</a></li> --}}
                            </ul>
                        </div>

    @elseif (session('role') == 'S')
                        {{--  Start Navigation Bar  --}}
        <div  class="col-12 fixed-top menu">
            <div class="menu-label">
                <div class="icon1 mx-3">
                    <i class="fa-solid fa-bars icons" ></i>
                </div>
                <div class="label mx-2">
                    Membership Managment
                </div>

                <div class="icon2 mx-3">
                <a href="/sale"> <i class="fa-solid fa-plus iconborder"></i></a>
                    <p class="sale">Quick Sales</p>
                </div>
            </div>
            

            <div class="account">
                <p class="admin">{{ session('name') }}</p>
                <a href="/logout">
                    <i class="fa-solid fa-power-off icons"></i>
                </a>
            </div>

        </div>
        
        {{-- Start Side Bar --}}
        <div class="container-fluid">
            <div class="row">
                    <div id="sidebar" class="col-lg-2 col-md-2 col-sm-2 sides on">
                       
                            <ul class="nav nav-pills flex-column mb-auto">
                              
                                <li class="small">sales</li>
                                <li class="nav-item sal"><a href="/sale" class="nav-link sal">Sales</a></li>
                                <li class="nav-item cu"><a href="/customer" class="nav-link cu">Customer</a></li>
                             
                            </ul>
                        </div>
    @endif
    
                            
                        
                    

                    <div id="content" class="col-lg-10 col-md-10 col-sm-10 showbody mt-5">
                        @yield('body')
                    </div>

                </div>
            </div>
        

   
</body>
</html>