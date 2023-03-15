@extends('layouts.app')

@section('template_title')
    Create Solicitude
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Solicitude</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('solicitudes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('solicitude.form')
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
