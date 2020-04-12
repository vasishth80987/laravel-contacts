@extends('layouts.admin')
@section('content')
    <article class="content responsive-tables-page">
        <div class="title-block">
            <h1 class="title">
                Invitations List
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
                                    @foreach($invitations as $item)
                                        <tr data-entry-id="{{ $item->id }}">
                                            <td></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->invitation_to_name }}</td><td>{{ $item->invitation_to_email }}</td></td>
                                            <td>
                                                <form method="POST" action="{{ url(config('vsynch_contacts.route_url_prefix').'/contacts/invitations/'  . $item->id. '/remove') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $invitations->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
