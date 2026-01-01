@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header ps-4 pe-4">
                <b style="font-size: 20px;">Edit Single MCQ</b>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('mcqs.update', $mcq) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label>Question</label>
                        <textarea name="question" class="form-control">{{ $mcq->question }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Mark</label>
                        <input type="number" name="mark" value="{{ $mcq->mark }}" class="form-control">
                    </div>

                    @foreach ($mcq->options as $key => $option)
                        <div class="mb-2">
                            <input type="radio" name="correct_option" value="{{ $key }}"
                                {{ $option->is_correct ? 'checked' : '' }}>
                            <input type="text" name="options[]" value="{{ $option->option_text }}"
                                class="form-control d-inline w-75">
                        </div>
                    @endforeach

                    <button class="btn btn-success mt-3">Update MCQ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
