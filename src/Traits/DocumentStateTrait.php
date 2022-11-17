<?php

namespace Sorethea\DocumentState\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Sorethea\DocumentState\Models\DocumentState;

trait DocumentStateTrait
{
    public static function boot(){
        parent::boot();
        self::created(function ($model){
            $model->setState(0);
        });
    }
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
    protected function state():Attribute{
        return new Attribute(
            function (): ?int{
                $documentState = $this->states()->where("active",true)->first();
                if(isset($documentState)) return$documentState->state;
                return null;
            }
        );
    }

    protected function setState(int $state):void {
        if(isset($this->states)) $this->states()->each(function ($model){
            $model->update(["active"=>false]);
        });
        $this->states()->save([
            "uuid"=>Str::random(),
            "state"=>$state,"causer_id"=>auth()->id(),
            "causer_type"=>get_class(auth()->user()),
            "active"=>true]);
    }

}
