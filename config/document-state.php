<?php
    return [
        "table_name" => "document_states",
        "document_state_model" => \Sorethea\DocumentState\Models\DocumentState::class,
        "status"=>[
            null=>"Not Available",
            0 => "Saved",
            1 => "Completed",
            2 => "Cancelled",
        ]
    ];
