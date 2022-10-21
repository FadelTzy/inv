<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }

    public function toArray($request)
    {
        // return [

        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'hp' => $this->hp,
        //     'alamat' => $this->alamat,
        //     'updated_at' => $this->updated_at,
        // ];

        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }
}
