@extends('admin.layout.app')

@section('content')

<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <h4>Add Service</h4>
        </div>

        <form action="{{ route('admin.services.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                @include('admin.services.partials.form')

            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn " style="background-color: #10b981; color: #fff;">
                    Save Service
                </button>
            </div>
        </form>
    </div>
</div>

@endsection