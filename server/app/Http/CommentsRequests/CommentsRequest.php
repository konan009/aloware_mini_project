<?php 

namespace App\Http\CommentsRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CommentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {   
        $rules =  [
            'comment_by'    => 'required|min:2|max:255',
            'comment_desc'  => 'required|min:2|max:255',
            'parent_ids'    => 'required|array|between:1,3',
        ];
        return $rules;
    }
}

?>