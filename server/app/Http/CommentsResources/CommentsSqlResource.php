<?php

namespace App\Http\CommentsResources;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CommentsSqlResource extends JsonResource
{

    public function __construct($resource)
    {
        // Ensure you call the parent constructor
        $this->data = $resource;
        
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $data_test = array();
        foreach ( $this->data as $data) {
            if($data->parents_child[0]->parent_id===$data->parents_child[0]->child_id){
                $date = Carbon::parse($data->created_at);
                $data_test["'".$data->id."'"] = array(
                    "id"            => $data->id,
                    "comment_desc"  => $data->comment_desc,
                    "comment_by"    => $data->comment_by,
                    "created_at"    =>  $date->diffInHours( Carbon::now() ),
                    "sub_comment"   => [],
                );
            }
            else{
                $data_test = $this->recursive_function($data_test, $data) ;
            }
        }
        return $data_test;
    }


    # APPLY RECURSION FOR TREE STRUCTURE OF COMMENTS
    public function recursive_function($data_test, $data){
            $id = "'".$data->parents_child[0]->parent_id."'";
            if( ( count(  $data->parents_child ) > 1 ) ){
                $data->parents_child->shift();
                $data_test[$id]["sub_comment"] = $this->recursive_function($data_test[$id]["sub_comment"], $data);
            }else{
                $date = Carbon::parse($data->created_at);
                $data_test["'".$data->id."'"] = [
                    "id"            => $data->id,
                    "comment_desc"  => $data->comment_desc,
                    "comment_by"    => $data->comment_by,
                    "created_at"    => $date->diffInHours( Carbon::now() ),
                    "sub_comment"   => [],
                ];
                return $data_test;
            }
        return $data_test;
    }
}
