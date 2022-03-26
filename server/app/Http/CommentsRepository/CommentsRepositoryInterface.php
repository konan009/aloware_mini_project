<?php

namespace App\Http\CommentsRepository;
use App\Http\CommentsRequests\CommentsRequest;
use App\Comments;
interface CommentsRepositoryInterface 
{
    public function get_comments( );
    public function add_comments( CommentsRequest $request );
}

?>