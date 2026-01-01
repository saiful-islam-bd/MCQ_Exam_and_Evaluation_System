@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header ps-4 pe-4">
                <b style="font-size: 20px;">MCQ Exam</b>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('exam.submit') }}">
                    @csrf

                    @foreach ($questions as $index => $question)
                        <div class="card mb-3">
                            <div class="card-body bg-light">
                                <h5 style="font-weight: 600">
                                    Q{{ $index + 1 }}. {{ $question->question }}
                                    <span class="badge bg-secondary float-end">
                                        {{ $question->mark }} Mark
                                    </span>
                                </h5>

                                @foreach ($question->options as $option)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                            value="{{ $option->id }}" required>

                                        <label class="form-check-label">
                                            {{ $option->option_text }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <button class="btn btn-success btn-lg">
                        Submit
                    </button>
                </form>
            </div>
        </div>


    </div>
@endsection
