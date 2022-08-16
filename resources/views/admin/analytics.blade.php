@extends('COMMON.layout')


@section('title')
    Admin |  Analytics
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/analytics.css") }}">
@endsection

@section('script')
     
@endsection

@section('body')

            <div class="container-fluid  mt-4 mx-2">
                   <div class="bor">
                    <div class="analytics ">
                        Analytics
                    </div>
                   </div>

                   

                   <div class="container">
                        <div class="d-flex justify-content-end m-3">
                            <select name="shop" id="shop" class="shop">
                              @forelse ($shops as $item)
                              <option value="{{ $item->id }}" >{{ $item->shop_name }}</option>
                             
                              @empty
                                  
                              @endforelse
                            </select>
                        </div>

                        
                            <p class="register">User Registrations</p>
                            <div class="bor-dash">
                            <div class="container-fluid mx-3">
                                <div class="row mx-5">
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Registrations</p>
                                        <span class="num">100 </span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                    </div>
    
                                    @forelse ($gender as $item)
                                    @if ($item->gender == 'male')
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Male</p>
                                        <span id="male" class="num">{{ $item->qty }} </span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                    </div>
                                    @else
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Female</p>
                                        <span id="female" class="num">{{ $item->qty }}</span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                    </div>
    
                                    @endif
                                   
                                    @empty
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Male</p>
                                        <span id="male" class="num">0</span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                    </div>
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Female</p>
                                        <span id="female" class="num">0</span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                    </div>
                                    @endforelse
                                  

                                    @php
                                        $active = 100 - count($total)
                                    @endphp
                                    
                                    <div class="col-md-3 col-sm-6 blog">
                                        <p class="reg">Active Users</p>
                                        <span class="active">{{ count($total) }} </span> <span>/</span> <span class="left">{{ $active }}</span>  <span class="user us"><i class="fa-solid fa-user"></i></span>
                                    </div>
                                    
                                </div>

                               
                            </div>
                        </div>

                            <p class="register mt-3">Active</p>
                            <div class="bor-dash">
                            <div class="container-fluid mx-3">
                                    <div class="row mx-5 collect">
                                      
                                        @forelse ($members as $item)
                                        <div class="col-md-3 col-sm-6 blog gpmember">
                                            <p class="reg">{{ $item->pgname }}</p>
                                            <span class="num">{{ $item->counts }}</span><span class="user"><i class="fa-solid fa-user us"></i></span>
                                           
                                        </div>
                                        @empty
                                       
                                        @endforelse
                                       
                                    </div>
                            </div>
                            </div>
                           


                            <p class="mt-3 ">Most purchased Customers</p>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-striped">
                                <thead class="tablebg">
                                    <th class="thbg">No</th>
                                    <th>Customer Name</th>
                                    <th>Card ID</th>
                                    <th>Phone Number</th>
                                    <th>Date of birth</th>
                                    <th>Address</th>
                                </thead>

                                <tbody class="purchased">
                                    <tr class="blank_row">
                                        <td class="norow" colspan="6"></td>
                                    </tr>

                                    @forelse ($totalamount as $item)
                                        <tr class="tabledata">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->customer_name }}</td>
                                            <td>{{ $item->card_id }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->dob }}</td>
                                            <td>{{ $item->address }}</td>
                                        </tr>
                                    @empty
                                        Still no user yet!!
                                    @endforelse
                                   
                                </tbody>
                            </table>
                            </div>


                            <div class="col-10  card chart mt-3 mb-3">
                                    
                                        <div class=" d-flex justify-content-end m-4" >
                                            <input type="date" name="cal" id="cal" value="{{ $today }}"> 
                                        </div>

                                        <div class="card-body">
                                            <canvas id="mylinechart"></canvas>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <p class="membership">Membership Daily Income</p>
                                        </div>
                                    
                            </div>
                   </div>
            </div>

            <script>
                
                var saleDaily = @json($dailyChart);
                console.log(saleDaily);
            </script>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset("js/analytics.js") }}"></script>
    <script src="{{ asset("js/dailyChart.js") }}"></script>
@endsection