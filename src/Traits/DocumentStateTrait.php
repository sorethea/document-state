<?php

namespace Sorethea\DocumentState\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sorethea\DocumentState\Models\DocumentState;

trait DocumentStateTrait
{
    protected $appends = ["is_active"];
    public function states(): MorphMany{
        return $this->morphMany(DocumentState::class,"document");
    }

    protected function isActive():\Attribute{
        return new \Attribute(
            fn()=>true
        );
    }
}
