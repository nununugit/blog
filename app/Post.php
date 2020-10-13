<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function order($select)
{
    if($select == 'asc'){
        return $this->orderBy('created_at', 'asc')->get();
    } elseif($select == 'desc') {
        return $this->orderBy('created_at', 'desc')->get();
    } else {
        return $this->all();
    }
}
}
