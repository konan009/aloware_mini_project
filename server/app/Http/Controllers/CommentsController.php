<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\CommentsResources\CommentsSqlResource;
use App\Http\CommentsResources\NewCommentResource;

use App\Http\CommentsRequests\CommentsRequest;

use App\Http\CommentsRepository\CommentsRepositoryInterface;
class CommentsController extends Controller
{

    public function __construct(CommentsRepositoryInterface $comments){
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $comments = $this->comments->get_comments();
            return (new CommentsSqlResource( $comments ));
        } catch (Throwable $e) {
            return $e;
        }

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
    public function store(CommentsRequest $request)
    {
        try {
            $new_comments = $this->comments->add_comments( $request );
            return (new NewCommentResource( $new_comments ));
        } catch (Exception $e) {
            throw $e;
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
