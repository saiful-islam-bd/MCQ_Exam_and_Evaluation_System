@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header ps-4 pe-4">
                <b style="font-size: 20px;">Create Bulk MCQs</b>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('mcqs.bulk.store') }}" method="POST">
                    @csrf

                    <div id="mcq-wrapper"></div>

                    <button type="button" class="btn btn-success mb-3" onclick="addMcq()">
                        + Add More MCQs
                    </button>

                    <br>

                    <button type="submit" class="btn btn-primary">
                        Save All MCQs
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        let mcqIndex = 0;

        function addMcq() {
            const html = `
    <div class="card mb-4 p-3">
        
        <div class="mb-2">
            <label>Question</label>
            <input type="text" name="mcqs[${mcqIndex}][question]" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Marks</label>
            <input type="number" name="mcqs[${mcqIndex}][mark]" class="form-control" value="1" required>
        </div>

        <label>Options</label>

        ${[0,1,2,3].map(i => `
                                <div class="input-group mb-1">
                                            <span class="input-group-text">
                                                <input type="radio"
                                                    name="mcqs[${mcqIndex}][correct_option]"
                                                    value="${i}" required>
                                            </span>
                                            <input type="text"
                                                name="mcqs[${mcqIndex}][options][${i}]"
                                                class="form-control"
                                                placeholder="Option ${i + 1}"
                                                required>
                                </div>
                                    `).join('')}

                <button type="button" class="w-25 mt-3 btn btn-sm btn-danger float-end" onclick="this.closest('.card').remove()"><i class="fa-solid fa-trash"></i> Remove</button>
    </div>
    `;

            document.getElementById('mcq-wrapper').insertAdjacentHTML('beforeend', html);
            mcqIndex++;
        }

        document.addEventListener('DOMContentLoaded', () => {
            addMcq();
        });
    </script>
@endpush
