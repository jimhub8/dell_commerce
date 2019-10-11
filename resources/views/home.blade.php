@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta, laudantium? Iusto saepe nam eligendi aliquid accusamus aperiam eos incidunt nostrum ipsam ratione commodi cum autem mollitia rerum, totam omnis laboriosam!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

