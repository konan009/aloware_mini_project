<?php

namespace App\Http\CommentsResources;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NewCommentResource extends JsonResource
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
        $date = Carbon::parse($this->data->created_at);
    
        $new_comment = [
            "id" => $this->data->id,
            "comment_desc" => $this->data->comment_desc,
            "comment_by" => $this->data->comment_by,
            "created_at" => $date->diffInHours( Carbon::now() ),
            "ids" => $this->data->parents_child()->get()
        ];  
        
        return $new_comment;


       

    }

}
