@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="myChart" style="max-width:700px; height:400px"></div>
                    <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
