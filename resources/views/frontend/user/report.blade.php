@extends('layouts.frontend.master')

@section('name')
    Result Exams: {{ $exam->name }}
@endsection

@section('title')
    Your Report Exams: {{ $exam->name }}
@endsection

@section('content')
    <div class="row">
        @if(isset($questions))
            @foreach($questions as $key => $question)
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                Question {{ $key+1 }}: {{ $question["content"] }}
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($question->answers)
                                @foreach($question->answers as $index => $answer)
                                    <div class="form-check">
                                        <label class="form-check-label 
                                            {{ $answer->correct ? 'text-success':'' }}
                                            {{ $question->answer_id === $answer->id ? 'text-danger':'' }}">
                                            <input type="radio" class="form-check-input" 
                                                name="answers[{{ $question["id"] }}]" id="" 
                                                value="{{ $answer["id"] }}">
                                            
                                            @php
                                                $answerTitle = 'A';
                                            @endphp

                                            {{ chr(ord($answerTitle) + $index)}}. {{ $answer["content"] }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        @endif
            
        <a class="btn btn-success btn-lg" href="{{ route('exam.show', ['id' => $exam->id]) }}"
            style="margin: 0 auto; width: 280px; display: block; margin-bottom: 20px"> Try Again </a>
    </div>
@endsection