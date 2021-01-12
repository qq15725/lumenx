<?php

namespace Lumenx\Console;

use EloquentFilter\Commands\MakeEloquentFilter;

class EloquentFilterMakeCommand extends MakeEloquentFilter
{
    protected $signature = 'make:model-filter {name}';
}