<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
           
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                    'title'=>'required|min:2',
                    'body'=>'required|min:3',
                    'category_id'=>'required|numeric'

                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            // Validation messages
            'title.min'=>'标题至少2字符',
            'body.min'=>'文章至少3字符'
        ];
    }
}
