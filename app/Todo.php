<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Todo extends Model
{
    protected $fillable = ['title', 'body'];


    protected $appends = ['created_date', 'body_html'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = Str::slug($value, '-');
    // }

    // public function getUrlAttribute()
    // {
    //     return route("todo.show", $this->slug);
    // }

    public function getCreatedDateAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->diffForHumans();
        } else {
            return "";
        }
    }


    public function getBodyHtmlAttribute()
    {
        // return clean($this->bodyHtml());
        return $this->bodyHtml();
    }





    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
    }

    public function excerpt($length)
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->bodyHtml()), $length);
    }

    private function bodyHtml()
    {
        return \Parsedown::instance()->text($this->body);
    }
}
