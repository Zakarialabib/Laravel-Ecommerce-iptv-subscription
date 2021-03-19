@extends('admin.layout')
@section('content')

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{__('Update Supplier')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{__('The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['supplier.update', $suppliers->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('name')}} *</strong> </label>
                                    <input type="text" name="name" value="{{$suppliers->name}}" required class="form-control">
                                </div>
                            </div>
                    
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>{{__('Company Name')}} *</label>
                                    <input type="text" name="company_name" value="{{$suppliers->company_name}}" required class="form-control">
                                    @if($errors->has('company_name'))
                                   <span>
                                       <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('VAT Number')}}</label>
                                    <input type="text" name="tax_number" value="{{$suppliers->tax_number}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Email')}} *</label>
                                    <input type="email" name="email" value="{{$suppliers->email}}" required class="form-control">
                                    @if($errors->has('email'))
                                   <span>
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Phone Number')}} *</label>
                                    <input type="text" name="phone_number" value="{{$suppliers->phone_number}}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Address')}} *</label>
                                    <input type="text" name="address" value="{{$suppliers->address}}"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('City')}} *</label>
                                    <input type="text" name="city"  value="{{$suppliers->city}}"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <input type="submit" value="{{__('submit')}}" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
</script>
@endsection
