<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\McqQuestion;
use App\Models\McqOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class McqController extends Controller
{
    public function index()
    {
        $mcqs = McqQuestion::with('options')->latest()->paginate(10);
        return view('admin.mcqs.index', compact('mcqs'));
    }

    public function create()
    {
        return view('admin.mcqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'mark' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'correct_option' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $question = McqQuestion::create([
                'question' => $request->question,
                'mark' => $request->mark,
            ]);

            foreach ($request->options as $key => $optionText) {
                McqOption::create([
                    'mcq_question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => ($key == $request->correct_option),
                ]);
            }
        });

        return redirect()->route('mcqs.index')
            ->with('success', 'MCQ created successfully');
    }

    public function edit(McqQuestion $mcq)
    {
        $mcq->load('options');
        return view('admin.mcqs.edit', compact('mcq'));
    }

    public function update(Request $request, McqQuestion $mcq)
    {
        $request->validate([
            'question' => 'required|string',
            'mark' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'correct_option' => 'required',
        ]);

        DB::transaction(function () use ($request, $mcq) {

            $mcq->update([
                'question' => $request->question,
                'mark' => $request->mark,
            ]);

            $mcq->options()->delete();

            foreach ($request->options as $key => $optionText) {
                McqOption::create([
                    'mcq_question_id' => $mcq->id,
                    'option_text' => $optionText,
                    'is_correct' => ($key == $request->correct_option),
                ]);
            }
        });

        return redirect()->route('mcqs.index')
            ->with('success', 'MCQ updated successfully');
    }

    public function destroy(McqQuestion $mcq)
    {
        $mcq->delete();

        return redirect()->route('mcqs.index')
            ->with('success', 'MCQ deleted successfully');
    }

    // bulk question create
    public function bulkCreate()
    {
        return view('admin.mcqs.bulk-create');
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'mcqs' => 'required|array|min:1',

            'mcqs.*.question' => 'required|string',
            'mcqs.*.mark' => 'required|integer|min:1',

            'mcqs.*.options' => 'required|array|size:4',
            'mcqs.*.correct_option' => 'required|integer|min:0|max:3',
        ]);

        DB::transaction(function () use ($request) {

            foreach ($request->mcqs as $mcqData) {

                $question = McqQuestion::create([
                    'question' => $mcqData['question'],
                    'mark' => $mcqData['mark'],
                ]);

                foreach ($mcqData['options'] as $index => $optionText) {
                    McqOption::create([
                        'mcq_question_id' => $question->id,
                        'option_text' => $optionText,
                        'is_correct' => $index == $mcqData['correct_option'],
                    ]);
                }
            }
        });

        return redirect()
            ->route('mcqs.index')
            ->with('success', 'MCQs created successfully!');
    }
    
}
