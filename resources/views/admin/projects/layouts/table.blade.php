@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        @if (Route::currentRouteName() == 'admin.projects.index')
        <a class="btn btn-success my-3 me-2" href="{{ route('admin.projects.create') }}">
            Add new project <i class="fas fa-plus"></i>
        </a>
        <a href="{{ route('admin.projects.bin') }}" class="btn btn-warning my-3">
            Go to the bin <i class="fas fa-trash"></i>
        </a>
        @elseif (Route::currentRouteName() == 'admin.projects.bin')
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary my-3">
            Go Back<i class="fas fa-arrow-left ms-2"></i>
        </a>
        @endif
        <table class="table table-responsive table-striped table-hover table-borderless mb-0 align-middle">
            <thead class="text-red">
                <tr class= text-red">
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                <tr>
                    <td class= text-red">{{ $project->id }}</td>
                    <td>{{ $project->author }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <div class="flex-align-center">
                            @if (Route::currentRouteName() == 'admin.projects.index')
                            <a class="btn btn-success me-2" href="{{ route('admin.projects.show', $project) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-secondary me-2" href="{{ route('admin.projects.edit', $project) }}">
                                <i class="fas fa-pencil"></i>
                            </a>

                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>

                            @elseif (Route::currentRouteName() == 'admin.projects.bin')
                            <form class="patch-form" action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning me-2" type="submit"><i class="fas fa-rotate"></i></button>
                            </form>

                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>

                            @endif
                        </div>
                        <!-- Modal -->
                        <div class="modal fade del-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ (Route::currentRouteName() == 'admin.projects.bin') ? 'Permanent deleting' : 'Deleting'}} {{ $project->title }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to {{ (Route::currentRouteName() == 'admin.projects.bin') ? 'permanent' : ''}} delete <span class="fw-bold">{{ $project->title }}</span>?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        @if (Route::currentRouteName() == 'admin.projects.index')
                                        <form class="del-form" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Cancel <i class="fas fa-trash fa-lg"></i></button>
                                        </form>
                                        @elseif (Route::currentRouteName() == 'admin.projects.bin')
                                        <form class="perma-del-form" action="{{ route('admin.projects.permanent-destroy', $project->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete <i class="fas fa-trash fa-lg"></i></button>
                                        </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-red">No more projects available...</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
    </div>
</main>
@endsection
