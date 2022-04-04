<?php

namespace App\Http\CommentsRepository;

use App\Comments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\CommentsRequests\CommentsRequest;

class CommentsRepository implements CommentsRepositoryInterface{
    
    public function __construct(){
    }

    public function get_comments(){
        return Comments::with('parents_child')->get();
    }

    public function add_comments(CommentsRequest $request){
        DB::beginTransaction();
        try {   
            $new_comment = new Comments();
            $new_comment->comment_by =  $request->comment_by;
            $new_comment->comment_desc = $request->comment_desc;
            $new_comment->created_at =  Carbon::now()->format('Y-m-d H:i:s');
            $new_comment->updated_at =  Carbon::now()->format('Y-m-d H:i:s');
            $new_comment->save();
            $parents_id = Comments::insert_parent_child_id( $request->parent_ids ,  $new_comment->id );
            DB::commit();
            return $new_comment;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
?>