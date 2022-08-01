
@extends('COMMON.layout')


@section('title')
    Admin | Transaction
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/transaction.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/sale.js") }}"></script>
@endsection

@section('body')

              <div class="container-fluid   mt-4 mx-2">
                  <div class="d-flex aligns-item-center bor">
                    <div class="new">
                        Add new
                </div>
                    <div class="history active">
                      Sales Histroy
                     </div>
                </div>

                 

                    <div class="table-responsive addnew close mt-3 bor">
                        
                            
                            <table class="table table-sm m-auto">
                                
                                <thead class="tablebg">
                                    <th>Customer Name</th>
                                    <th>Card ID</th>
                                    <th>Invoice No</th>
                                    <th>Price</th>
                                
                                </thead>
                                <tbody>
        
                                    <tr class="blank_row">
                                        <td class="norow" colspan="6"></td>
                                    </tr>
                                   <tr>
                                    <td><input type="text" name="name" id="name" class="inputs" ></td>
                                    <td><input type="text" name="card" id="card" class="inputs" required></td>
                                    <td><input type="text" name="invoice" id="invoice" class="inputs" required></td>
                                    <td><input type="number" name="price" id="price" class="inputs type" required></td>
                                   </tr>
                                </tbody>
                          
                        
                            </table>
                            
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                    <p class="data">Confirm Data</p>
                            </div>
        
                            <div class="show">
                                
                            <table class="table table-sm m-auto">
                                <form action="{{ route('sale.store') }}" method="POST">
                                    @csrf
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
                                   <tr>
                                    <td >1</td>
                                    <td><input type="text" name="cname" id="cname" class="inputs nobor"  readonly></td>
                                    <td><input type="text" name="ccard" id="ccard" class="inputs nobor" readonly></td>
                                    <td><input type="text" name="cinvoice" id="cinvoice" class="inputs nobor" readonly></td>
                                    <input type="hidden" name="cprice" id="cprice" class="inputs hidden" >
                                    <td class="cprice"></td>
                                    <td class="membership"></td>
                                    <td class="transactiontime"></td>
        
                                   </tr>
                                </tbody>
                          
                            </table>
        
                            <div class="d-flex justify-content-end align-items-end mt-3 p-3 m-3  ">
                                    <button class="btn btn-secondary confirm ">Confirm</button>
                                    <button  class="btn btn-danger cancel ">Cancel</button>
                            </div>
                        </form>
                            </div>
        
        
                        
                    </div>



                    <div class="historytable open mt-3">
                       
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


                            <select name="reference" id="reference" class="reference">
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
                            <div class="input-group mt-3 searchgroup">

                                <button  class="btn searchicon senddata" ><i class="fa-solid fa-magnifying-glass glass"></i></button>
                                <input type="text" name="search" class="search" id="search"  placeholder="Search with card id.....">
                                
                            </div>
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
                          
                            @forelse ($result as $item)
                            <tr class="alldata">
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
                        <p class="items">Total Items : <span class="sale-count">{{ count($count) }}</span></p>

                        <div class="d-flex justify-content-center links">{{ $result->links() }}</div>
                   </div>
                    </div>
              </div>
              
              

            
@endsection 