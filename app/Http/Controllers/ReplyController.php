<?php

namespace App\Http\Controllers;

use App\Event\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\newReplyNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
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
    public function index(Question $question)
    {
        return ReplyResource::collection($question -> reply);
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
    public function store(Question $question,Request $request)
    {
        $reply = $question -> reply() -> create($request -> all());
        $user = $question -> user;
        if($reply -> user_id !== $question -> user_id){
            $user->notify(new newReplyNotification($reply));
        }
        return response(['reply' => new ReplyResource($reply)],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        Reply::where('id',$id) -> update([
            'body' => $request -> body
        ]);
        $reply = Reply::find($id);
        return response(['reply'=>$reply],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = Reply::find($id);
        $reply -> delete();
        broadcast(new DeleteReplyEvent($reply -> id,0))->toOthers();
        return response('Deleted',204);
    }
}
