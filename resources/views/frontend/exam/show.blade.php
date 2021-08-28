@extends('layouts.frontend.master')

@section('name')
    Exams: {{ $exam->name }}
@endsection

@section('title')
    Exams: {{ $exam->name }}
@endsection

@section('content')
    <div class="row">
        <form action="{{ route('exam.submit', ['exam_id' => $exam->id]) }}" method="POST">
        @csrf
            @if(isset($exam->questions))
                @foreach($exam->questions as $key => $question)
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
                                            <label class="form-check-label">
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
            
            <button type="submit" class="btn btn-success btn-lg" 
                style="margin: 0 auto; width: 280px; display: block; margin-bottom: 20px"> Submit </button>
        </form>
    </div>
@endsection