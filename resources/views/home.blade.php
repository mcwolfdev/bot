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
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">+</a>
                    <a class="btn btn-success" href="/home">Approve ({{$qacount2->count()}})</a>
                    <a class="btn btn-danger" href="{{ route('show.only.approve')}}">Need approve ({{$qacount->count()}})</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qatext as $key=>$p)
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
                                    @if ($p->approve == 0)
                                    <a class="btn btn-success" href="{{ route('approve', $p->id)}}">approve</a>
                                    @endif
                                </td>

                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
<!--                            <a class="btn btn-success" href="{{ route('create') }}">+</a>-->

                    <br/>
                    {{$qatext->links('vendor.pagination.simple-bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить новую запись</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create')}}" method="post">
                    @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="qw" class="form-control rounded-3" id="questionInput" placeholder="Вопрос">
                    <label for="questionInput">Вопрос:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="an" class="form-control rounded-3" id="answerInput" placeholder="Ответ">
                    <label for="answerInput">Ответ:</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
        </div>
    </div>
</div>



@endsection
