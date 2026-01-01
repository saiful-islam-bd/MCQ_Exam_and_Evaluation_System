@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 col-lg-3 col-md-3 col-sm-12"></div>

            <div class="col-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card text-center m-5">
                    <div class="card-header">
                        <b style="font-size: 22px; color:blue">Exam Result</b>
                    </div>
                    <div class="card-body">
                        <p class="fs-5">
                            <strong>Total Marks:</strong> {{ $result->total_marks }}
                        </p>

                        <p class="fs-5">
                            <strong>Obtained Marks:</strong> {{ $result->obtained_marks }}
                        </p>

                        <a href="{{ route('exam.index') }}" class="btn btn-primary mt-3">
                            Retake Exam
                        </a>
                    </div>
                    <div class="card-footer text-body-secondary">
                        Work Hard & Keep Learing!!!
                    </div>
                </div>
            </div>

            <div class="col-3 col-lg-3 col-md-3 col-sm-12"></div>

        </div>
    </div>
@endsection
