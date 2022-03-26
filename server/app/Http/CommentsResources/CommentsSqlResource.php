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
            $parents =  explode(",",$data->parent_ids);
       
            if($data->id==$data->parent_ids){
                $date = Carbon::parse($data->created_at);
                $data_test["'".$data->id."'"] = array(
                    "id"            => $data->id,
                    "comment_desc"  => $data->comment_desc,
                    "comment_by"    => $data->comment_by,
                    "created_at"    =>  $date->diffInHours( Carbon::now() ),
                    "sub_comment"   => [],
                );
            }else{
                $data_test = $this->recursive_function($data_test, $parents, $data) ;
            }
        }
        return $data_test;
    }


    # APPLY RECURSION FOR TREE STRUCTURE OF COMMENTS
    public function recursive_function($data_test, $parents_ids, $data){
            $id = array_shift($parents_ids);
            $id = "'".$id."'";
            if( ( count( $parents_ids ) > 1 ) ){
                $data_test[$id]["sub_comment"] = $this->recursive_function($data_test[$id]["sub_comment"], $parents_ids, $data);
            }else{
                $date = Carbon::parse($data->created_at);
                $data_test[$id]["sub_comment"]["'".$data->id."'"] = [
                    "id"            => $data->id,
                    "comment_desc"  => $data->comment_desc,
                    "comment_by"    => $data->comment_by,
                    "created_at"    => $date->diffInHours( Carbon::now() ),
                    "sub_comment"   => [],
                ];
            }
        return $data_test;
    }
}
