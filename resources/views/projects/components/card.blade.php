<div class="card" style="height: 200px;">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
        <a class="text-black no-underline" href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
    </h3>

    <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
</div>