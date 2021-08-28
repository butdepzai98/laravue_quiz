@extends('layouts.frontend.master')

@section('name')
    All Exams
@endsection

@section('title')
    All your Exams
@endsection

@section('content')
<div class="row">
    <!-- Exam -->
    @foreach($exams->items() as $key => $exam)
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 {{ $bgs[array_rand($bgs)] }} text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-table"></i> 
                        Exam {{ $exam["id"] }}: 
                        {{ $exam["name"] }}
                    </h6>
                </div>
                <div class="card-body">
                    <p>Number question: {{ $exam->questions->count() }}</p>
                    <p class="text-danger">Time: 60 min</p>
                    <a class="btn btn-primary" href="{{ route('exam.show', ['id' => $exam->id]) }}" role="button">Test now</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-12 d-flex justify-content-center">
        {{ $exams->links() }}
    </div>
</div>
@endsection

