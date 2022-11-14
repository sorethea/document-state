<?php

namespace Sorethea\DocumentState\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Query\Builder;

class DocumentState extends Model
{
    protected $table = "document_states";

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

    public function scopeActiveStateDocument(Builder $query, Model $document):Builder{
        return $query
            ->where("document_type", $document->getMorphClass())
            ->where("document_id",$document->getKey())
            ->where("active","=",true);
    }
}
