@extends('layouts.admin')
@section('content')
    <article class="content forms-page">
        <div class="title-block">
            <h3 class="title"> {{\Illuminate\Support\Str::plural(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}} </h3>
            <p class="title-description"></p>
        </div>
        <div class="subtitle-block">
            <h3 class="subtitle">  </h3>
        </div>
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-md-12 col-lg-6">
                    <div class="card card-block sameheight-item">
                        <div class="card-header">Request New {{\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}}</div>
                        <div class="card-body">
                            <a href="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/requests/new') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <vsync-form-validator :model-data="{{json_encode(count(old())==0?(isset($address) ? $address : []):old())}}" :target-form="'createContact'" inline-template>
                                <validation-observer ref='createContactObserver'>
                                    <form method="POST" ref='createContact' id="createContact" @submit.prevent="onSubmit('createContact')" action="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/requests/new') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            <label for="name" class="control-label">{{ trans('addresses.name') }}</label>
                                            <validation-provider rules="required" v-slot="{ errors }" ref="nameValidationProvider">
                                                <input class="form-control" name="name" type="text" id="name" v-model="formData.name" >
                                                <span class="vee-error">@{{ errors[0] }}</span>
                                            </validation-provider>
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        <div class="form-group {{ $errors->has('companies') ? 'has-error' : ''}}">
                                            <label for="email" class="control-label">Email Address</label>
                                            <select name="email" class="form-control" id="email" required>
                                                <option></option>
                                            </select>
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>


                                        <div class="form-group">
                                            <input class="btn btn-primary" type="submit" value="Add">
                                        </div>

                                    </form>
                                </validation-observer>
                            </vsync-form-validator>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#email').select2({
                placeholder: 'Choose Email..',tags: true,
                createTag: function (params) {
                    var email = $.trim(params.term);

                    var re = /\S+@\S+\.\S+/;
                    if(!re.test(email))return null;
                    return {
                        id: email,
                        text: email,
                        newTag: true // add additional parameters
                    }
                }
            });
        });
    </script>
@endsection
