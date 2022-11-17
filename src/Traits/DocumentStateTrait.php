<?php

namespace Sorethea\DocumentState\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sorethea\DocumentState\Models\DocumentState;

trait DocumentStateTrait
{
    public function states(): MorphMany{
        return $this->morphMany(DocumentState::class,"document");
    }

    protected function isActive():Attribute{
        return new Attribute(
            function (){
                $documentState = $this->states()->where("active",true)->first();
                if(isset($documentState) && $documentState->state<2) return true;
                else return false;
            }
        );
    }
    protected function status():Attribute{
        return new Attribute(
            function ():string{
                $documentState = $this->states()->where("active",true)->first();
                if(isset($documentState)) return config("document-state.status")[$documentState->state];
                else return config("document-state.status")[null];
            }
        );
    }
}
