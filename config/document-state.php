<?php
    return [
        "table_name" => "document_states",
        "document_state_model" => \Sorethea\DocumentState\Models\DocumentState::class,
        "status"=>[
            0 => "Saved",
            1 => "Submitted",
            2 => "Cancelled",
        ]
    ];
