<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::with('reply.like','user') -> latest() -> get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = \auth() -> user() -> id;
        $question = Question::create($request -> all());
        return response(new QuestionResource($question),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question -> update($request -> all());
        return response(['Updated'],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question -> delete();
        return response('Deleted',201);
    }
}
