@extends('COMMON.layout')


@section('title')
    Admin | Setting
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/setting.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/setting.js") }}"></script>
@endsection

@section('body')
                <div class="container-fluid  mt-4 mx-2">
                     <div class="d-flex aligns-item-center bor">
                            <div class="new">
                                 Add new
                          </div>
                             <div class="history active">
                                   User Accounts
                             </div>


                            
                             
                     </div>

                     <div class="useraccount mt-3 close">
                        <form action="{{ route('setting.store') }}" method="POST">
                               @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label"  for="name"><span class="text-danger">*</span>User name</label>
                                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter user name" />
                              
                            </div>
                            
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password"><span class="text-danger">*</span>Password</label>
                                <input type="text" name="password" id="password" class="form-control" required placeholder="Enter user password" />
                              
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="cfmpassword"><span class="text-danger">*</span>Confirm Password</label>
                                <input type="text" name="cfmpassword" id="cfmpassword" class="form-control"  required placeholder="Confirm password"/>
                              
                            </div>

                            <p class="permission">User role Permissions</p>
                           
                            @if (session('role') == 'SA')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio" name="admin" type="checkbox" id="inlineCheckbox1" value="SA">
                                <label class="form-check-label" for="inlineCheckbox1">Super admin</label>
                              </div>
                            @endif
                            
                              <div class="form-check form-check-inline">
                                <input class="form-check-input radio" name="admin" type="checkbox" id="inlineCheckbox2" value="S">
                                <label class="form-check-label" for="inlineCheckbox2">Sales</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input radio" name="admin" type="checkbox" id="inlineCheckbox3" value="OP">
                                <label class="form-check-label" for="inlineCheckbox3">Manager</label>
                              </div>

                              <p class="permission mt-3">Branches</p>
                              @forelse ($shops as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio" name="shop" type="checkbox"  value="{{ $item->id }}">
                                    <label class="form-check-label" for="shop">{{ $item->shop_name }}</label>
                                </div>
                            @empty
                                
                            @endforelse
                            

                              <div class="d-flex  align-items-center mt-3 ">
                                <button  class="btn btn-secondary confirm">Save</button>
                                <button  class="btn btn-danger cancel">Cancel</button>
                            </div>
                        </form>

                     </div>

                     <div class="allusers open p-5">

                        <div class="caption">All Users</div>
                        <table class="table table-borderless tablebor">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>User name</th>
                                {{-- <th>Password</th> --}}
                                <th>Roles</th>
                                <th colspan="1" class="text-center">Action</th>
                                {{--  <th>Active</th>  --}}
                              </tr>
                            </thead>
                            <tbody>

                                @forelse ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->username }}</td>
                                        {{-- <td>{{ $item->password }}</td> --}}
                                        
                                        @switch($item->role)
                                            @case("SA")
                                            <td>Super Admin</td>
                                            {{--  <td> <i class="fa fa-pencil pen"></i>
                                                <i class="fa-solid fa-circle-xmark xmark"></i>
                                               <i class="fa-solid fa-circle-check check"></i>
                                            </td>  --}}
                                                @break
                                            @case("OP")
                                            <td>Manager</td>
                                            {{--  <td> 
                                                <i class="fa-solid fa-circle-xmark xmark"></i></a>
                                               <i class="fa-solid fa-circle-check check"></i>
                                            </td>  --}}
                                                @break
                                            @case("S")
                                            <td>Sale</td>
                                                {{--  <td> 
                                                   <i class="fa-solid fa-circle-check check"></i>
                                                </td>  --}}
                                                @break
                                            @default
                                                
                                        @endswitch
                                        {{--  @if ($item->active == 1)
                                        <td><div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  checked>
                                    
                                          </div></td>
                                        @else
                                        <td><div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  >
                                    
                                          </div></td>
                                        @endif  --}}

                                        <td><a href="{{ route('setting.edit', $item->id) }}"><button
                                            class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Edit</button></a> </td>
                                        <td>
                                            <form action="{{ route('setting.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">
                                                     Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                              
                            </tbody>
                        </table>

                     </div>
                    </div>

@endsection