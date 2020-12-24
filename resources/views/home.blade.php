@extends('layouts.app')

@section('content')
<div class="container p-0">
    {{-- <div class="row justify-content-center"> --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <App></App>
    {{-- </div> --}}
</div>
@endsection
