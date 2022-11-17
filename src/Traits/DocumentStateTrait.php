<?php

namespace Sorethea\DocumentState\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sorethea\DocumentState\Models\DocumentState;

trait DocumentStateTrait
{
    protected $appends = ["is_active"];
    public function states(): MorphMany{
        return $this->morphMany(DocumentState::class,"document");
    }

    protected function isActive():Attribute{
        return new Attribute(
            function (){
                $documentState = $this->states()->where("active",true)->first();
                if($documentState->state<2) return true;
                else return false;
            }
        );
    }
}
