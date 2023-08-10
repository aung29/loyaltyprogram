@extends('COMMON.layout')


@section('title')
    Admin |  Customer Detail
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/detail.css") }}">
@endsection

@section('script')
       <script src="{{ asset("js/detail.js") }}"></script>
@endsection

@section('body')


                <div class="container-fluid mt-3 mx-2">
                    {{-- <div class="container-fluid"></div> --}}
                    {{-- <table class="table">
                        <thead>
                          <tr>
                            <td >Customer Detail</td>
                            <td >Address</td>
                            <td >Contact</td>
                            <td ><i class="fas fa-edit "></i></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                                <span>Name   -   {{ $result[0]->customer_name }}</span>
                                <br>
                                <span>ID</span>
                            </td>
                           
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                         
                        </tbody>
                    </table> --}}

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Customer Details</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th> 
                                <i class="fas fa-edit editicon " data-bs-toggle="modal" data-bs-target="#modal">
                           
                            </i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                                <span>
                                  <p> <span class="name">Name -  </span><input type="text" name="cusname" id="cusname"   class="name border-0"value="{{ $result[0]->customer_name }}"></p>
                                  {{-- <p> <span class="name">ID -</span><input type="text" name="" id=""  class="name border-0"value="{{ $result[0]->card_id }}"></p>  --}}
                                    
                                    {{-- <p class="name">Name - {{ $result[0]->customer_name }}</p> --}}
                                    <p class="name" >ID - <span id="cusid">{{ $result[0]->card_id }}</span></p>
                                </span>
                            </td>
                            <td class="street"><input type="text"  id="cusadd" name="cusadd" class="detailadd border-0" value="{{$result[0]->address }}"></td>
                            <td class="phone"><input type="text" name="cusphone" id="cusphone" class="phoneadd border-0" value="{{ $result[0]->phone }}"></td>
                          </tr>
                    </table>
                   
                    {{-- <div class="row  mt-4 d-flex justify-content-between detail-border">
                        <span class="col-3 pt-1 detail ">Customer Details</span>
                        <span class="col-4 pt-1 address">Address</span>
                        <span class="col-3 pt-1 contact">Contact</span>
                        <span class="col-2 pt-1 edits">
                            <i class="fas fa-edit "></i>
                        </span>
                    </div> --}}

                    {{-- <div class="container-fluid row">
                        <div class="col-3 mt-3 mx-1 d-flex">
                           <div class="d-flex flex-column name">
                               <span>Name</span>
                            <br>
                               <span class="pre">ID</span>
                           </div>
                          
                           <div class="d-flex flex-column mx-3 cardid">
                               <span class="cusNam">{{ $result[0]->customer_name }}</span>
                           <br>
                               <span>{{ $result[0]->card_id }}</span>
                           </div>
                          
                        </div>
                        <div class="col-4 mt-3">
                            <p class="street">{{ $result[0]->address }}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p class="phone">{{ $result[0]->phone }}</p>
                        </div>
                    </div> --}}


                    
                    <div class="row">
                        <div class="amount">
                            <div class="amounts">Total Amount</span>  <span class="kyats">{{ number_format($result[0]->total_amount) }} Ks</div>
                         
                            <div class="amounts">Usage History</span> <span class="kyats">{{ number_format($result[0]->reset_time) }} times</div>

                            <div class="amounts">Reset Amount</span> <span class="kyats">{{ number_format($result[0]->reset_amount) }} Ks</div>
                        </div>

                       
                    
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-between btm">
                           
                            @for ($i = 0; $i < count($ref); $i++)
                            {{-- @if (  $ref[$i]->kyat_from >=$result->total_amount ||$ref[$i]->kyat_from <= $result->total_amount && $ref[$i]->kyat_to >= $result->total_amount ) --}}
                            <div class="rank">
                            <span class="ranks">Rank</span>  <span class="reachrank">{{ $ref[$i]->program_name; }} -You need <span> {{ number_format($ref[$i]->kyat_to - $result[0]->total_amount)}} Ks </span> points to exchange cupon</span>

                            </div>
                            <div class="quantity">
                            <span class="">{{ number_format($result[0]->total_amount) }} /  </span><span> {{ number_format($ref[$i]->kyat_to) }} </span>
                            </div>
                            
                    
                       

                        {{-- <div class="row">
                            <div class="rank">
                                <span class="ranks">Next Rank</span>  <span class="club">{{ $ref[$i+1]->program_name ?? $ref[$i]->program_name; }}</span>
                             
                            </div>
                        </div> --}}
                            {{-- @break --}}
                            {{-- @endif --}}
                            @endfor
                             
                          
                      


                        </div>
                    
                    </div>

                    <form action="">
                        <div class="searchengine">
                            <div class="input-group mt-3">
                                <button class="btn export"> <a href="/customers/{{ $result[0]->id }}" class="excels"> Export </a> </button>
                                <button  class="btn rotate" ><i class="fa-solid fa-rotate-right"></i></button>
                                
                            </div>
                            
                        </div>
                        {{--  need to output data from transaction table  --}}
                        <div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
                            <table class="table  table-striped table-sm m-auto tablefont">
                                <thead class="tablebg">
                                    {{-- <th class="thbg">No</th> --}}
                                    <th class="thbg">Transaction Date</th>
                                    <th>Card ID</th>
                                    <th>Member Type</th>
                                    <th>Note</th>
                                    <th>Amount</th>
                                    {{--  <th>Branch</th>  --}}
                                </thead>
                                <tbody class="confirmdata">
        
                                    <tr class="blank_row">
                                        <td class="norow" colspan="7"></td>
                                    </tr>
                                    @forelse ($result2 as $item)
                                    <tr>
                                        <td>{{ $item->transaction_date }}</td>
                                        <td>{{ $item->card_id }}</td>
                                        <td>{{ $item->program_name }}</td>
                                        @if ($item->note == "")
                                        <td>Empty</td>
                                         @else
                                        <td>{{ $item->note }}</td>
                                        @endif
                            
                                        <td>{{ number_format($item->amount) }} Ks</td>
                                        {{--  <td>{{ $item->shop_name }}</td>  --}}
                                        {{--  <td>{{ $item-> }}</td>  --}}
                                    </tr>
                                    @empty
                                        There is no data.
                                    @endforelse
                                   
                                  
        
                                  
                                </tbody>
                          
                            </table>
                            </div>
                            
                       </form>

                       <div class="totalamounts d-flex justify-content-end align-items-center ">
                            <div class="total col-lg-3 col-md-5 col-sm-2 d-flex justify-content-around align-items-center m-3">
                                <p class="totals ">Total Amounts <span class="alltotal">{{ number_format($result3)}} Ks</span></p>

                             
                            </div>
                       </div>
                       <div class="d-flex justify-content-between mt-5">
                        <p class="items">Total Items : <span>{{ count($result2  ) }}</span></p>

                        <div class="d-flex justify-content-center">{{ $result2->links() }}</div>
                   </div>

                      
                </div>



                     {{-- start modal --}}
            <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header"> --}}

                    <div class="d-flex justify-content-end ">
                        <button type="button" class="cross" data-bs-dismiss="modal"
                            aria-label="Close">&times;</button>
                    </div>
                    {{-- </div> --}}
                    {{-- <div class="modal-body"> --}}
                    <p class="mx-4"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>Are you sure you want to update customer information?</p>
                    {{-- </div> --}}
                    <div class="modal-footer">
                    <a href="">  <button type="button" id="editicon" class="btn btnYes  bg-danger text-light" >Yes</button></a>
                        <button type="button" class="btn btnNo bg-secondary text-light" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}


                          
@endsection