@extends('layouts.admin')
@section('content')
    <article class="content forms-page">
        <div class="title-block">
            <h3 class="title"> {{\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}} </h3>
            <p class="title-description"></p>
        </div>
        <div class="subtitle-block">
            <h3 class="subtitle">  </h3>
        </div>
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-md-6">
                    <div class="card card-block sameheight-item">
                        <div class="card-header">{{\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}} ID: {{ $contactUser->id }}</div>
                        <div class="card-body">

                            <a href="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                            <form method="POST" action="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/' . $contactUser->pivotId. '/remove')  }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $contactUser->id }}</td>
                                    </tr>
                                    <tr><th> Contact Name </th><td> {{ $contactUser->name }} </td></tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection