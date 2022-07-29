@extends('COMMON.layout')


@section('title')
    Admin | User Update
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/customer.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/customer.js") }}"></script>
@endsection

@section('body')
                <div class="container-fluid   mt-4 mx-2">
                        <div class="d-flex aligns-item-center bor">
                                <div class="new ">
                                        Add new
                                </div>
                                <div class="history active">
                                        Customer List
                                    </div>
                         </div>


                         <div class="table-responsive addnew close mt-3 ">
                            <form action="{{ route('customer.store') }}" method="POST">
                                @csrf
                                <table class="table table-sm m-auto">
                                    <thead class="tablebg">
                                      
                                        <th>Customer Name</th>
                                        <th>Card ID</th>
                                        <th>Phone Number</th>
                                        <th>Date Of Birth</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                    
                                    </thead>
                                    <tbody>
            
                                        <tr class="blank_row">
                                            <td class="norow" colspan="6"></td>
                                        </tr>
                                       <tr>
                                        
                                        <td><input type="text" name="name"  id="name" class="inputs" autofocus required autocomplete="off" ></td>
                                        <td><input type="text" name="card" id="card" class="inputs" required autocomplete="off"></td>
                                        <td><input type="text" name="phone" id="phone" class="inputs" required autocomplete="off"></td>
                                        <td><input type="text" name="dob" id="dob" class="inputs" autocomplete="off" ></td>
                                        <td><input type="text" name="address" id="address" class="inputs" required autocomplete="off"></td>
                                        <td><div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                          </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                    @error('card')
                                    <small class="text-danger mx-5">{{ $message }}</small>
                                    @enderror
                                </table>
                                <div class="d-flex justify-content-end align-items-end mt-3 p-3 m-3">
                                    <button type="submit" class="btn btn-secondary confirm">Confirm</button>
                                    <button  class="btn btn-danger cancel">Cancel</button>
                                 </div>
                            </form>
                        </div>


                        <div class="historytable open mt-3">
                        
                        <div class="category d-flex ">
                            <select name="username" id="username" class="username">
                                <option value="" selected disabled>Customer</option>
                                @if (count($count) > 0)
                                @forelse ($count as $item)
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
                                <button class="btn export">Export </button>
                                <button  class="btn rotate" ><i class="fa-solid fa-rotate-right"></i></button>
                                
                            </div>
                            <div class="input-group mt-3 searchgroup">

                                <button  class="btn  searchicon" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                <input type="text" name="search" class="search" id="search"  autocomplete="off" placeholder="Search with card id......">
                                
                            </div>
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
                            <th ></th>
                        
                        </thead>
                        <tbody class="confirmdata">

                            <tr class="blank_row">
                                <td class="norow" colspan="7"></td>
                            </tr>
                        @if (count($result) > 0)
                                @forelse ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->card_id }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->dob }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td class="text-center"><a href="{{ route('customer.show', $item->id) }}"><button
                                            class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Detail</button></a></td>
                                    </tr>
                                @empty
                                    There is no data
                                @endforelse                            
                        @endif
                          
                        </tbody>
                  
                    </table>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <p class="items">Total Items : <span class="cards">{{ count($count) }}</span></p>

                        <div class="d-flex justify-content-center links">{{ $result->links() }}</div>
                   </div>
                    </div>

                    </div>
@endsection