<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comments extends Model
{
    public static function comments_custom_sql()
    {
        return DB::table('comments')
        ->selectRaw('id,comments.comment_desc,comments.comment_by,GROUP_CONCAT(comments_parent_child.parent_id) as parent_ids,created_at')
        ->leftjoin('comments_parent_child', 'comments.id', '=', 'comments_parent_child.child_id')
        ->groupBy('comments.id');
    }

    public static function insert_parent_child_id($parents_id,$new_comment_id)
    {

        $new_comment_pivot_record = [];
        
        foreach ($parents_id as $value) {
            $new_comment_pivot_record[] = [
                'parent_id' => $value,
                'child_id' => $new_comment_id
            ];
        }
        
        $new_comment_pivot_record[] = [
            'parent_id' => $new_comment_id,
            'child_id' => $new_comment_id
        ];

        $result = DB::table('comments_parent_child')->insert( $new_comment_pivot_record );
        
        return $new_comment_pivot_record;
    }

}
