<?php

namespace Sorethea\DocumentState;

use Illuminate\Support\ServiceProvider;
use Sorethea\DocumentState\Models\DocumentState;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DocumentStateServiceProvider extends PackageServiceProvider
{
    public  function configurePackage(Package $package): void{
        $package->name("document-state")
            ->name("document-state")
            ->hasConfigFile('document-state')
            ->hasMigrations(['create_document_state_table']);
    }

}
