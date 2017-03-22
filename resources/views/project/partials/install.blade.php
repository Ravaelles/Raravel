<div class="panel panel-default panel-full-buttons">
    <div class="panel-heading">Install</div>
    <div class="panel-body">
        <div class="dropdown">

            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Install package
                <span class="caret ml5"></span>
            </button>

            <ul class="dropdown-menu pt5 pb5" aria-labelledby="dropdownMenu1">
                @foreach ($installers as $installer)
                <li class="p10" style="padding-top: 1px !important; padding-bottom: 1px !important;">
                    <a class="btn btn-default" target="_blank"
                       href="{!! route('project.install', 
                       ['project' => $project->getName(), 'install' => $installer->getName()]) !!}"
                       @include('partials.ui.tooltip', [
                       'message' => str_replace('"', "'", $installer->getCommand()) . "<br /><br />If needed adds providers and aliases to config/app.php and creates default route."
                        ])>
                       {!! $installer->getName() !!}
                </a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>