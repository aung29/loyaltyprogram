@extends('COMMON.layout')


@section('title')
    Admin |  Customer Detail
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/detail.css") }}">
@endsection

@section('script')
       
@endsection

@section('body')


                <div class="container-fluid   mt-3 mx-2">
                    <div class="row  mt-4 d-flex justify-content-between detail-border">
                        <div class="col-3 pt-1 detail ">Customer Details</div>
                        <div class="col-4 pt-1 address">Address</div>
                        <div class="col-3 pt-1 contact">Contact</div>
                        <div class="col-2 pt-1 edits">
                            <i class="fas fa-edit "></i>
                        </div>
                    </div>

                    <div class="container-fluid row">
                        <div class="col-3 mt-3 mx-1 d-flex">
                           <div class="d-flex flex-column name">
                               <span>Name</span>
                               <span>ID</span>
                           </div>
                           <div class="d-flex flex-column mx-3 cardid">
                               <span>{{ $result->customer_name }}</span>
                               <span>{{ $result->card_id }}</span>
                           </div>
                          
                        </div>
                        <div class="col-4 mt-3">
                            <p class="street">{{ $result->address }}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p class="phone">{{ $result->phone }}</p>
                        </div>
                    </div>


                    
                    <div class="row">
                        <div class="amount">
                            <span class="amounts">Amount</span>  <span class="kyats">{{ number_format($result->total_amount) }} Ks</span>
                         
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-between btm">
                            <div class="rank">
                            @for ($i = 0; $i < count($ref); $i++)
                            @if (  $ref[$i]->kyat_from >=$result->total_amount ||$ref[$i]->kyat_from <= $result->total_amount && $ref[$i]->kyat_to >= $result->total_amount )
                            <span class="ranks">Rank</span>  <span class="reachrank">{{ $ref[$i+1]->program_name ??  $ref[$i]->program_name; }} -You need <span> {{ number_format($ref[$i]->kyat_to - $result->total_amount)}} Ks </span> points to rank up</span>

                            </div>
                            <div class="quantity">
                            <span class="">{{ number_format($result->total_amount) }} /  </span><span> {{ number_format($ref[$i]->kyat_to) }} </span>
                                </div>
                            </div>
                    
                        </div>

                        <div class="row">
                            <div class="rank">
                                <span class="ranks">Next Rank</span>  <span class="club">{{ $ref[$i+1]->program_name ?? $ref[$i]->program_name; }}</span>
                             
                            </div>
                            @break
                            @endif
                            @endfor
                             
                          
                      


                    
                    
                    </div>

                    <form action="">
                        <div class="searchengine">
                            <div class="input-group mt-3">
                                <button class="btn export">Export </button>
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
                                    <th>Branch</th>
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
                                        <td>{{ $item->shop_name }}</td>
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
                            <div class="total col-3 d-flex justify-content-between align-items-center m-3">
                                <p class="totals">Total Amounts <span class="alltotal">{{ number_format($result->total_amount) }} Ks</span></p>

                             
                            </div>
                       </div>
                       <div class="d-flex justify-content-between mt-5">
                        <p class="items">Total Items : <span>{{ count($result2  ) }}</span></p>

                        <div class="d-flex justify-content-center">{{ $result2->links() }}</div>
                   </div>

                      
                </div>
@endsection