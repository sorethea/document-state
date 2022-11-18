<?php

namespace Sorethea\DocumentState\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DocumentState extends Model
{
    public function __construct(array $attributes = [])
    {
        if(!isset($this->table)){
            $this->setTable(config('document-state.table_name'));
        }
        parent::__construct($attributes);
    }
    protected $fillable = [
        "uuid",
        "active",
        "state",
        "causer_id",
        "causer_type",
        ];

    protected $casts = [
        "properties"=>"collection",
    ];

    public function document(): MorphTo{
        return $this->morphTo();
    }

    public function causer(): MorphTo{
        return $this->morphTo();
    }

    public function scopeCauseBy(Builder $query, Model $causer): Builder{
        return $query
            ->where("causer_type", $causer->getMorphClass())
            ->where("causer_id", $causer->getKey());
    }
    public function scopeForDocument(Builder $query, Model $document):Builder{
        return $query
            ->where("document_type", $document->getMorphClass())
            ->where("document_id",$document->getKey());
    }

    public function scopeActiveDocument(Builder $query, Model $document):Builder{
        return $query
            ->where("document_type", $document->getMorphClass())
            ->where("document_id",$document->getKey())
            ->where("active","=",true);
    }

//    public function scopeActive(Builder $query){
//        return $query->where("state","!=",2);
//    }
}
