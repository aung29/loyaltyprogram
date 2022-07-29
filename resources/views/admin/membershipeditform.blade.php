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
                    <div class="new active">
                            Edit Form
                    </div>
                </div>

                <div class="col-12">
                    <hr class="col-md-12 col-sm-12 line"/>
                </div>

                <div class="formmember open">
                    <form action="{{ route('membership.update', $result->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-outline mb-4">
                            <label class="form-label"  for="pgname"><span class="text-danger">*</span>Program name</label>
                            <input type="text" id="pgname" name="pgname" class="form-control" required value="{{ $result->program_name }}"/>
                          
                        </div>
                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="damount"><span class="text-danger">*</span>Discount Amount</label>
                            <input type="text" id="damount"  name="damount" class="form-control" required value="{{ $result->discount }}"  />
                          
                        </div>
                        
                

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="kyatf">Kyats From</label>
                                <input type="number" id="kyatf" name="kyatf" class="form-control"  required value="{{ $result->kyat_from }}"/>
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="kyatt">Kyats To</label>
                                    <input type="number" id="kyatt" name="kyatt" class="form-control"  required value="{{ $result->kyat_to }}"/>
                                </div>
                            </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="stdate">Start Date</label>
                                <input type="date" id="stdate" name="stdate" class="form-control" required value="{{ $result->start_date }}"/>
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="eddate">End Date</label>
                                    <input type="date" id="etdate" name="eddate" class="form-control"  value="{{ $result->end_date }}"/>
                                </div>
                            </div>
                      </div>
                      

                      <div class="form-outline mb-4">
                        <label class="form-label" for="note">Note</label>
                       <textarea name="note"  id="note" class="form-control" cols="30" rows="7">{{ $result->note }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end align-items-end mt-3 p-3 m-3">
                        <button type="submit" class="btn save">Update</button>
                        <a href="/membership"> <button  class="btn cancel">Cancel</button></a>
                </div>
                
           </form>
                   </div>
            </div>
@endsection