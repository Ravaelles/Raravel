<?php
$hasProjectSelected = $currentProject != null;
?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav sidebar">

        <li {!! !$hasProjectSelected ? 'class="active"' : '' !!}>
            <a href="/"><i class="fa fa-lg fa-fw fa-dashboard"></i> All Projects</a>
        </li>

        @if ($hasProjectSelected)
        <li {!! $hasProjectSelected ? 'class="active"' : '' !!}>
            <a href="{!! route('project.show', $currentProject->getName()) !!}">
                <!--<i class="fa fa-lg fa-fw fa-sitemap"></i>--> 
                <img class="sidebar-favicon" src="{!! $project->getFavicon() !!}" />
                {!! $currentProject->getName() !!}
            </a>
        </li>
        @endif

    </ul>
</div>