  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSS only -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('css/common.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</head>
<body>
    {{--  Start Login Section --}}
     <section class="">
        <div class="container-fluid d-flex justify-content-center align-items-center logins">
            <div class="row">
                <div class="col-lg-6 col-md-2 col-sm-1 shopimage ">
                    <div class="container">
                        <div class="main-image">
                            <img src="{{ url('image/title.png') }}" alt="">
                        </div>

                        <div class="sub-image m-5">
                            <div class="sub1">
                                <img src="{{ url('image/image 1.png') }}" alt="" class="subimages">
                            </div>

                            <div class="sub1">
                                <img src="{{ url('image/image 1.png') }}" alt="" class="subimages">
                            </div>

                            <div class="sub1">
                                <img src="{{ url('image/image 4.png') }}" alt="" class="subimages">
                            </div>

                            <div class="sub1">
                                <img src="{{ url('image/image 5.png') }}" alt="" class="subimage1">
                            </div>

                            <div class="sub1">
                                <img src="{{ url('image/image 6.png') }}" alt="" class="subimage2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10 ">
                   
                 <div class="container blogs">
                <div class="form-containers">
                    <div class="imageblog">
                        <img src="{{ url('image/image 1.png') }}" alt="logo" class="images">
                    </div>
                    <div class="form-container mt-4">
                        <form action="/admin" method="POST" class="forms">
                            @csrf
                            <div class="title">
                                <p class="titles">LOGIN</p>
                            </div>

                            <div class="form-group mx-5 margins ">
                                <label for="name" >Username</label>
                                <input type="text" class="form-control inputs" id="name" name="name"  required autocomplete="off">
                               
                            </div>
                            @error('name')
                            <small class="text-danger mx-5 margins">{{ $message }}</small>
                            @enderror
                            <div class="form-group mx-5 margins">
                                <label for="password">Password</label>
                                <input type="password" class="form-control inputs" id="password" name="password" required autocomplete="off" >
                               
                            </div>
                            @error('password')
                            <small class="text-danger mx-5 margins">{{ $message }}</small>
                            @enderror

                           <div>
                                <button type="submit" class=" btns mt-4 btnmargin">Login</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
</body>  
</html> 