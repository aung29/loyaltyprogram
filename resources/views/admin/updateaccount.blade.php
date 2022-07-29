@extends('COMMON.layout')


@section('title')
    Admin | User Update
@endsection

@section('css')
        <link rel="stylesheet" href="{{  url("css/userUpdate.css") }}">
@endsection

@section('script')
        <script src="{{ url("js/userUpdate.js") }}"></script>
@endsection

@section('body')

            <div class="container-fluid  mx-2">
                    <div class="updateForm">
                        <form action="{{ route('setting.update',$result->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <a href="/setting" class="back">< Back to all users</a>

                            <div class="change text-center mt-2">Change & Update</div>
                            <div class="form-outline mb-4">
                                <label class="form-label"  for="name"><span class="text-danger">*</span>User name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $result->username }}" required />
                              
                            </div>
                            
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password"><span class="text-danger">*</span>Password</label>
                                <input type="text" id="password" name="password" class="form-control" value="{{ $result->password }}" required />
                              
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="cfmpassword"><span class="text-danger">*</span>Confirm Password</label>
                                <input type="text" id="cfmpassword" name="cfmpassword" class="form-control"  value="{{ $result->password }}" required/>
                              
                            </div>

                            <div class="d-flex  justify-content-center align-items-center mt-3 ">
                                <button  class="btn btn-secondary confirm">Update</button>
                                <button  class="btn btn-danger cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
            </div>
@endsection