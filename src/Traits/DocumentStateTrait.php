<?php

namespace Sorethea\DocumentState\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sorethea\DocumentState\Models\DocumentState;

trait DocumentStateTrait
{
    public function states(): MorphMany{
        return $this->morphMany(DocumentState::class,"document");
    }
}
