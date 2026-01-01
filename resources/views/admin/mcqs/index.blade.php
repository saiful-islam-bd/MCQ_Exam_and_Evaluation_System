@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header ps-4 pe-4">
                <b style="font-size: 20px;">All MCQs List</b>
            </div>
            <div class="card-body p-4">
                <a href="{{ route('mcqs.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Add MCQ</a>

                @foreach ($mcqs as $mcq)
                    <div class="card mb-3 bg-body-secondary">
                        <div class="card-body">
                            <strong>{{ $mcq->question }}</strong>
                            <p style="font-size: 14px; color: blue; margin-bottom:5px;">Mark: {{ $mcq->mark }}</p>

                            <ul>
                                @foreach ($mcq->options as $option)
                                    <li>
                                        {{ $option->option_text }}
                                        @if ($option->is_correct)
                                            ✅
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('mcqs.edit', $mcq) }}" class="btn btn-sm btn-success mt-2"><i class="fa-regular fa-pen-to-square"></i> Edit</a>

                            <form action="{{ route('mcqs.destroy', $mcq) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger mt-2"
                                    onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{ $mcqs->links() }}
            </div>
        </div>



    </div>
@endsection
