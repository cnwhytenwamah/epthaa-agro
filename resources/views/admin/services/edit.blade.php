@extends('admin.layout.app')

@section('content')

<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <h4>Edit Service</h4>
        </div>

        <form action="{{ route('admin.services.update',$service) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                @include('admin.services.partials.form')

            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    Update Service
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
