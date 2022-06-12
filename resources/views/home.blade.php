@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    {{--@if (session('status'))

                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    --}}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qatext as $p)
                            <tr>
                                <form action="{{ route('edit', $p->id)}}" method="post">
                                    @csrf
                                <th scope="row">{{ $p->id }}</th>
                                <td>
                                    <input id="question" name="question" class="form-control" type="text" placeholder="Text question" aria-label="default input example" value="{{ $p->text_type}}">
                                </td>
                                <td>
                                    <input id="answer" name="answer" class="form-control" type="text" placeholder="Text answer" aria-label="default input example" value="{{ $p->answer}}">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">edit</button>
                                    <a class="btn btn-danger" href="{{ route('delete', $p->id)}}">del</a>

                                </td>

                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <a class="btn btn-success" href="{{ route('create') }}">+</a>
                    <br/>
                    {{$qatext->links('vendor.pagination.simple-bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
