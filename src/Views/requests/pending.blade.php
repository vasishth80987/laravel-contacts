@extends('layouts.admin')
@section('content')
    <article class="content responsive-tables-page">
        <div class="title-block">
            <h1 class="title">
                Pending Requests List
            </h1>
            <p class="title-description">  </p>
        </div>
        <section class="section">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                                    @foreach($requests as $item)
                                        <tr data-entry-id="{{ $item->id }}">
                                            <td></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td><td>{{ $item->email }}</td></td>
                                            <td>
                                                <a href="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/requests/' . $item->pivotId.'/accept') }}" title="Accept"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Accept</button></a>
                                                <form method="POST" action="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/requests/'  . $item->pivotId. '/remove') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Deny Request" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deny</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $requests->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
