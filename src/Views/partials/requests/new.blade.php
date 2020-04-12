<article class="content forms-page">
<section class="section">
    <div class="row sameheight-container">
        <div class="col-md-12">
            <div class="card card-block sameheight-item">
                    <vsync-form-validator :ajax-submit="true" :modal-ref="'{{isset($modalRef)?$modalRef:''}}'" :model-data="{{json_encode(count(old())==0?(isset($address) ? $address : []):old())}}" :target-form="'createContact'" inline-template>
                        <validation-observer ref='createContactObserver'>
                            <form method="POST" ref='createContact' id="createContact" @submit.prevent="onSubmit('createContact')" action="{{ url(config('vsynch_contacts.api_route_url_prefix').'contacts/requests/new').'?api_token='.\Illuminate\Support\Facades\Auth::user()->api_token }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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
                                    <validation-provider rules="required" v-slot="{ errors }" ref="emailValidationProvider">
                                        <input class="form-control" name="email" type="email" id="email" v-model="formData.email" >
                                        <span class="vee-error">@{{ errors[0] }}</span>
                                    </validation-provider>
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
</section>
</article>