@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header ps-4 pe-4">
                <b style="font-size: 20px;">Create Single MCQ</b>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('mcqs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Question</label>
                        <textarea name="question" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Mark</label>
                        <input type="number" name="mark" class="form-control" required>
                    </div>

                    @for ($i = 0; $i < 4; $i++)
                        <div class="mb-2">
                            <input type="radio" name="correct_option" value="{{ $i }}" required>
                            <input type="text" name="options[]" class="form-control d-inline w-75" required>
                        </div>
                    @endfor

                    <button class="btn btn-primary mt-3">Save MCQ</button>
                </form>
                </form>
            </div>
        </div>
    </div>
@endsection
