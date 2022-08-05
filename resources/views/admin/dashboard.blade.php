@extends('COMMON.layout')


@section('title')
    Admin | Dashboard
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/dashboard.css") }}">
@endsection

@section('body')

        <div class="container-fluid col-12 mx-2">
            <p class="dashboardtext">Overall Dashboard</p>
            
            @php
                $cardCount = 1;
            @endphp
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-4 mx-3">
                    @if (count($cardResult) > 0)
                       @forelse ($cardResult as $item)
                       
                            {{--  @if ($ref[$i]->program_name == $item->program_name)  --}}
                            <div class="m-2 cart{{ $cardCount }}">
                                <div class="card-title mx-4 title">{{ $item->program_name }}</div>
                                <div class="mt-4 mx-4">
                                    <div class="numblog">
                                        {{ $item->counts }}
                                    </div>
                                    <p class="customer">Total Customer</p>
                                </div>
                                <div class="mx-4">
                                    <div class="total">{{ number_format($item->total)}} Ks</div>
                                    <p class="income mb-1">Total Incomes</p>
                                </div>
                            </div>
                            
                                 
                            @php
                                $cardCount++;
                            @endphp
                        
                      @empty
                            
                      @endforelse  
                        
                      @else

                      <div class="m-2 cart1">
                        <div class="card-title mx-4 title">Silver Member</div>
                        <div class="mt-4 mx-4">
                            <div class="numblog">
                                0
                            </div>
                            <p class="customer">Total Customer</p>
                        </div>
                        <div class="mx-4">
                            <div class="total">0  Ks</div>
                            <p class="income mb-1">Total Incomes</p>
                        </div>
                    </div>

                    <div class="m-2 cart2">
                        <div class="card-title mx-4 title">Gold Member</div>
                        <div class="mt-4 mx-4">
                            <div class="numblog">
                                0
                            </div>
                            <p class="customer">Total Customer</p>
                        </div>
                        <div class="mx-4">
                            <div class="total">0  Ks</div>
                            <p class="income mb-1">Total Incomes</p>
                        </div>
                    </div>

                    <div class="m-2 cart3">
                        <div class="card-title mx-4 title">Platinum Member</div>
                        <div class="mt-4 mx-4">
                            <div class="numblog">
                                0
                            </div>
                            <p class="customer">Total Customer</p>
                        </div>
                        <div class="mx-4">
                            <div class="total">0  Ks</div>
                            <p class="income mb-1">Total Incomes</p>
                        </div>
                    </div>
                      @endif

                   

                     
                </div>
                
                <div class="col-lg-5 col-md-6 col-sm-8 totalall">
                       <div class="header-top">
                        <div class="header-blog">
                            <p class="greet">Hello,<span>Admin</span></p>
                            
                        </div> 
                        <div class="date-blog ">
                            <div class="calender  ">
                               <input type="date" name="date" id="date"  class="custom-date" readonly value="{{ $date }}"> 
                            </div>
                            
                        </div> 
                       </div>


                       <div class="mt-4 text-center">
                            <small class="amount">Total Sale amounts</small>
                            <p class="all-amounts">{{ number_format($total[0]->total) }} Ks</p>
                       </div>


                       <table class="table">
                           <thead>
                               <th >Branches</th>
                               <th >Type</th>
                               <th class="text-center">Total</th>
                               <th class="text-end">Sale Amounts</th>

                           </thead>

                           <tbody>
                              @php
                                $count = 0;    
                                $totalCount =count($dash[0]) + count($dash[1])+ count($dash[2])+ count($dash[3]);
                              @endphp
                            @forelse ($dash[0] as $result)
                               
                                  
                                   <tr>
                                    <td>{{ $result->shop_name }}</td>
                                    <td>{{ $result->program_name }}</td>
                                    <td class="text-center">{{ $result->counts }}</td>
                                    <td class="text-end">{{ $result->total }}</td>
                                 </tr>
                                 
                                  
                               
                            @empty
                                There is no tranaction yet!!;
                            @endforelse

                            <tr class="blank_row">
                                <td class="norow" colspan="4"></td>
                            </tr>
                              
                            @forelse ($dash[1] as $result)
                               
                                  
                            <tr>
                             <td>{{ $result->shop_name }}</td>
                             <td>{{ $result->program_name }}</td>
                             <td class="text-center">{{ $result->counts }}</td>
                             <td class="text-end">{{ $result->total }}</td>
                          </tr>
                          
                            
                        
                     @empty
                        
                     @endforelse

                     <tr class="blank_row">
                        <td class="norow" colspan="4"></td>
                    </tr>

                     @forelse ($dash[2] as $result)
                               
                                  
                     <tr>
                      <td>{{ $result->shop_name }}</td>
                      <td>{{ $result->program_name }}</td>
                      <td class="text-center">{{ $result->counts }}</td>
                      <td class="text-end">{{ $result->total }}</td>
                   </tr>

                   
                    
                 
              @empty
                
              @endforelse

                        <tr class="blank_row">
                                <td class="norow" colspan="4"></td>
                            </tr>


              @forelse ($dash[3] as $result)
                               
                                  
              <tr>
               <td>{{ $result->shop_name }}</td>
               <td>{{ $result->program_name }}</td>
               <td class="text-center">{{ $result->counts }}</td>
               <td class="text-end">{{ $result->total }}</td>
            </tr>
            
             
          
       @empty
           
       @endforelse

                            
                           </tbody>
                       </table>


                       <div class="d-flex justify-content-between mt-5">
                            <p class="items">Total Items : <span>{{ $totalCount }}</span></p>

                           
                       </div>
                </div>
            </div>
        </div>
@endsection