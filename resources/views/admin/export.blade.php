@extends('COMMON.layout')


@section('title')
    Admin | Export
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/export.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/export.js") }}"></script>
@endsection

@section('body')
                    <div class="container-fluid   mt-4 mx-2">
                            <div class="d-flex aligns-item-center bor">
                                     <div class="sales active">
                                            Sale Report
                                     </div>
                                    <div class="customers">
                                            Customer List Report
                                    </div>
                            </div>


                            <div class="saletable open mt-3">
                                
                                <div class="category d-flex ">
                                    <select name="username" id="username" class="username">
                                        <option value="" selected disabled>Customer</option>
                                 @if (count($cardCount) > 0)
                                @forelse ($cardCount as $item)
                                <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                @empty
                                    
                                @endforelse
                              
                                @endif
                                    </select>
        
        
                                    <select name="username" id="username" class="reference">
                                        <option value="" selected disabled>Reference</option>
                                        @if (count($ref) > 0)
                                        @forelse ($ref as $item)
                                        <option value="{{ $item->id }}">{{ $item->program_name }}</option>
                                        @empty
                                            
                                        @endforelse
                                      
                                        @endif
                                    </select>
                                </div>
        
                                <div class="searchengine">
                                    <div class="input-group mt-3">
                                       
                                        <button class="btn export"> <a href="excel-export2" class="excels"> Export </a> </button>
                                         <button  class="btn rotate" >  <a href="excel-export2" class="excels"> <i class="fa-solid fa-rotate-right"></i> </a></button>
                                        
                                    </div>
                                    {{--  <div class="input-group mt-3 searchgroup">
        
                                        <button  class="btn  searchicon" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                        <input type="text" name="search" class="search" id="search"  placeholder="Search....">
                                        
                                    </div>  --}}
                                </div>
                          
        
                            <div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
                            <table class="table table-striped table-sm m-auto tablefont">
                                <thead class="tablebg">
                                    <th class="thbg">No</th>
                                    <th>Customer Name</th>
                                    <th>Card ID</th>
                                    <th>Invoice No</th>
                                    <th>Price</th>
                                    <th>Reference</th>
                                    <th>Date Create</th>
                                
                                </thead>
                                <tbody class="confirmdata">
        
                                    <tr class="blank_row">
                                        <td class="norow" colspan="7"></td>
                                    </tr>
                                    @forelse ($sale as $item)
                                       <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->card_id }}</td>
                                        <td>{{ $item->invoice }}</td>
                                        <td>{{ number_format($item->amount) }} Ks</td>
                                        <td>{{ $item->program_name }}</td>
                                        <td>{{ $item->transaction_date }}</td>
                                    </tr>
                                    @empty
                                        There is no data.
                                    @endforelse
                                 
                                </tbody>
                          
                            </table>
                            </div>
        
                            <div class="d-flex justify-content-between mt-5">
                                <p class="items">Total Items : <span>{{ count($saleCount) }}</span></p>
        
                                <div class="d-flex justify-content-center">{{ $sale->links() }}</div>
                           </div>
                            </div>



                            <div class="customertable close mt-3">
                            
                                <div class="category d-flex ">
                                    <select name="username" id="username" class="username">
                                        <option value="" selected disabled>Customer</option>
                                        @if (count($cardCount) > 0)
                                        @forelse ($cardCount as $item)
                                        <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                        @empty
                                            
                                        @endforelse
                                      
                                        @endif
                                    </select>
        
        
                                    <select name="username" id="username" class="reference">
                                        <option value="" selected disabled>Reference</option>
                                        @if (count($ref) > 0)
                                        @forelse ($ref as $item)
                                        <option value="{{ $item->id }}">{{ $item->program_name }}</option>
                                        @empty
                                            
                                        @endforelse
                                      
                                        @endif
                                    </select>
                                </div>
        
                                <div class="searchengine">
                                    <div class="input-group mt-3">
                                        <button class="btn export">  <a href="/excel-export1" class="excels"> Export </a> </button>
                                <button  class="btn rotate" ><a href="/excel-export1" class="excels"> <i class="fa-solid fa-rotate-right"></i></a></button>
                                        
                                    </div>
                                    {{-- <div class="input-group mt-3 searchgroup">
        
                                        <button  class="btn  searchicon" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                        <input type="text" name="search" class="search" id="search"  placeholder="Search....">
                                        
                                    </div> --}}
                                </div>
                            
        
                            <div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
                            <table class="table table-striped table-sm m-auto tablefont">
                                <thead class="tablebg">
                                    <th class="thbg">No</th>
                                    <th>Customer Name</th>
                                    <th>Card ID</th>
                                    <th>Phone Number</th>
                                    <th>Date of birth</th>
                                    <th>Address</th>
                                   
                                
                                </thead>
                                <tbody class="confirmdata">
        
                                    <tr class="blank_row">
                                        <td class="norow" colspan="7"></td>
                                    </tr>
                                    @forelse ($card as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->customer_name }}</td>
                                            <td>{{ $item->card_id }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->dob }}</td>
                                             <td>{{ $item->address }}</td>
                                        </tr>
                                    @empty
                                        There is no data
                                    @endforelse
                                 
                                </tbody>
                          
                            </table>
                            </div>
        
                            <div class="d-flex justify-content-between mt-5">
                                <p class="items">Total Items : <span>{{ count($card) }}</span></p>
        
                                <div class="d-flex justify-content-center">{{ $card->links() }}</div>
                           </div>
                            </div>
                    </div> 



@endsection