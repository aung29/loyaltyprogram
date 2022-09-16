@extends('COMMON.layout')


@section('title')
    Admin |  Membership
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/membership.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/membership.js") }}"></script>
@endsection

@section('body')

                <div class="container-fluid   mt-4 mx-2">
                  
                    <div class="d-flex aligns-item-center">
                                {{-- <div class="new ">
                                        Add new
                                </div> --}}
                                 <div class="program active">
                                        Membership Program
                                </div>
                        </div>

                        
                    <div class="col-12">
                        <hr class="col-md-12 col-sm-12 line"/>
                    </div>

                   
{{--                     
                      <div class="formmember close">
                        <form action="{{ route('membership.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label"  for="pgname"><span class="text-danger">*</span>Program name</label>
                                <input type="text" id="pgname" name="pgname" class="form-control" required/>
                              
                            </div>
                            
                            <div class="form-outline mb-4">
                                <label class="form-label" for="damount"><span class="text-danger">*</span>Discount Amount</label>
                                <input type="text" id="damount"  name="damount" class="form-control" required />
                              
                            </div>
                            
                    

                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="kyatf">Kyats From</label>
                                    <input type="number" id="kyatf" name="kyatf" class="form-control"  required/>
                                </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="kyatt">Kyats To</label>
                                        <input type="number" id="kyatt" name="kyatt" class="form-control"  required/>
                                    </div>
                                </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="stdate">Start Date</label>
                                    <input type="date" id="stdate" name="stdate" class="form-control"  required/>
                                </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="eddate">End Date</label>
                                        <input type="date" id="etdate" name="eddate" class="form-control"  />
                                    </div>
                                </div>
                          </div>
                          

                          <div class="form-outline mb-4">
                            <label class="form-label" for="note">Note</label>
                           <textarea name="note"  id="note" class="form-control" cols="30" rows="7"></textarea>
                        </div>

                        <div class="d-flex justify-content-end align-items-end mt-3 p-3 m-3">
                            <button type="submit" class="btn save">Save</button>
                            <button  class="btn cancel">Cancel</button>
                    </div>
                    
               </form>
                       </div> --}}
                   
                       <div class="tablemember open">
                         
                            <div class="searchengine">
                                <div class="input-group mt-3">
                                    <button class="btn export"> <a href="excel-export3" class="excels"> Export </a> </button>
                                    <button  class="btn rotate" >   <i class="fa-solid fa-rotate-right"></i></button>
                                    
                                </div>
                                <div class="input-group mt-3 searchgroup">
    
                                    <button  class="btn  searchicon" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                    <input type="text" name="search" class="search" id="search"  autocomplete="off" placeholder="Search with program name">
                                    
                                </div>
                            </div>
                       
                            <div class="table-wrapper-scroll-y my-custom-scrollbar mt-4">
                                <table class="table  table-sm m-auto tablefont">
                                    <thead class="tablebg">
                                        {{-- <th class="thbg">No</th> --}}
                                        <th class="thbg">Program Name</th>
                                        <th>Discount</th>
                                        <th>Kyats From</th>
                                        <th>Kyats To</th>
                                        <th>Note</th>
                                        <th>Date Create</th>
                                        <th>Action</th>
                                        <th colspan="2"></th>
                                    </thead>
                                    <tbody class="confirmdata">
            
                                        <tr class="blank_row">
                                            <td class="norow" colspan="7"></td>
                                        </tr>
                                       
                                        @if (count($result) > 0)
                                                @forelse ($result as $item)
                                                <tr>
                                       
                                                    <td>{{ $item->program_name }}</td>
                                                    <td>{{ $item->discount }}%</td>
                                                    <td>{{ number_format($item->kyat_from) }} Ks</td>
                                                    <td>{{ number_format($item->kyat_to) }} Ks</td>
                                                   @if ($item->note == "")
                                                   <td>Empty</td>
                                                   @else
                                                    <td>{{ $item->note }}</td>
                                                   @endif
                            
                                                    <td> {{  $item->start_date }}</td>
                                                    @if ($item->active == 1)
                                                    <td><div class="form-check form-switch">
                                                        <input class="form-check-input actives" type="checkbox"  id="{{ $item->id }}" checked>
                                                
                                                      </div></td>
                                                    @else
                                                    <td><div class="form-check form-switch">
                                                        <input class="form-check-input actives" type="checkbox"  id="{{ $item->id }}" >
                                                
                                                      </div></td>
                                                    @endif
                                                    <td><a href="{{ route('membership.edit', $item->id) }}"><button
                                                        class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Edit</button></a> </td>
                                                    {{-- <td>
                                                        <form action="{{ route('membership.destroy',$item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger">
                                                                 Delete
                                                            </button>
                                                        </form>
                                                    </td> --}}
                                                   </tr>
                                                @empty
                                                    There is no data
                                                @endforelse
                                        @endif
                                       
            
            
                                       <tr>
                                        <td></td>
                                        
                                       </tr>
                                       <tr>
                                           <td></td>
                                       </tr>
                                    </tbody>
                              
                                </table>
                                </div>
                  
                           <div class="d-flex justify-content-between mt-5">
                            <p class="items">Total Items : <span class="members">{{ count($result) }}</span></p>
    
                            <div class="d-flex justify-content-center links">{{ $result->links() }}</div>
                       </div>
                       </div>
                      {{--  @else  --}}

                    

                </div>

@endsection