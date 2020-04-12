@extends('layouts.admin')
@section('content')
    <article class="content responsive-tables-page">
        <div class="title-block">
            <h1 class="title">
                {{\Illuminate\Support\Str::plural(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}} List
            </h1>
            <p class="title-description">  </p>
        </div>
        <section class="section">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-buttons">
                                <div style="margin-bottom: 10px;" class="row">
                                    <div class="col-lg-12">
                                        <a href="{{ url('/admin/contacts/requests/new') }}" class="btn btn-primary-outline" title="Add New Address">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add New {{\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst(config('vsynch_contacts.view_name')))}}
                                        </a>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable">
                                    <thead>
                                    <tr>
                                        <th></th><th>#</th><th>Name</th><th>Email</th><th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $item)
                                        <tr data-entry-id="{{ $item->id }}">
                                            <td></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td><td>{{ $item->email }}</td></td>
                                            <td>
                                                <a href="{{ url('/admin/contacts/' . $item->pivotId.'/show') }}" title="View Contact"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>

                                                <form method="POST" action="{{ url('/admin/contacts/' . $item->pivotId.'/remove') }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $contacts->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection