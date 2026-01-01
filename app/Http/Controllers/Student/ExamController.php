<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\McqQuestion;
use App\Models\StudentAnswer;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index()
    {
        $questions = McqQuestion::with('options')->get();
        return view('student.exam.index', compact('questions'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $user = auth()->user();

        DB::transaction(function () use ($request, $user) {

            // Remove previous attempt (optional but clean)
            StudentAnswer::where('user_id', $user->id)->delete();
            ExamResult::where('user_id', $user->id)->delete();

            $questions = McqQuestion::with('options')->get();

            $totalMarks = 0;
            $obtainedMarks = 0;

            foreach ($questions as $question) {

                $totalMarks += $question->mark;

                $selectedOptionId = $request->answers[$question->id] ?? null;

                $isCorrect = false;
                $marksObtained = 0;

                if ($selectedOptionId) {
                    $correctOption = $question->options
                        ->where('is_correct', true)
                        ->first();

                    if ($correctOption && $correctOption->id == $selectedOptionId) {
                        $isCorrect = true;
                        $marksObtained = $question->mark;
                        $obtainedMarks += $question->mark;
                    }

                    StudentAnswer::create([
                        'user_id' => $user->id,
                        'mcq_question_id' => $question->id,
                        'mcq_option_id' => $selectedOptionId,
                        'is_correct' => $isCorrect,
                        'marks_obtained' => $marksObtained,
                    ]);
                }
            }

            ExamResult::create([
                'user_id' => $user->id,
                'total_marks' => $totalMarks,
                'obtained_marks' => $obtainedMarks,
                'submitted_at' => now(),
            ]);
        });

        return redirect()->route('exam.result');
    }

    public function result()
    {
        $result = ExamResult::where('user_id', auth()->id())->latest()->first();

        if (!$result) {
            return redirect()->route('exam.index');
        }

        return view('student.exam.result', compact('result'));
    }
    
}


