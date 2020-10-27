<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $var = Questionnaire::find(1);
        // dd($var->questions);
        return view('questionnaire.create', compact('var'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required',
        ]);

        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect('/questionnaires/'.$questionnaire->id);
    }

    public function show(\App\Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses');

        return view('questionnaire.show', compact('questionnaire'));
    }
}
