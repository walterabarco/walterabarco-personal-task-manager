@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 950px;">
    
    <!-- Top Header Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center gap-2">
            <div class="text-white rounded-4 p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #064e52;">
                <i class="bi bi-check2-all fs-5"></i>
            </div>
            <div>
                <span class="fw-bold fs-5 text-dark d-block" style="line-height: 1.1;">Taskify</span>
                <small class="text-muted" style="font-size: 11px;">Pro Workspace</small>
            </div>
        </div>
        <div class="badge bg-light text-secondary border px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-calendar-event me-1" style="color: #00838f;"></i> {{ date('F j, Y') }}
        </div>
    </div>

    <!-- Hero Banner with Custom Teal Gradient -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #064e52 0%, #00838f 100%);">
        <div class="position-absolute top-0 end-0 p-4 opacity-10 d-none d-md-block">
            <i class="bi bi-rocket-takeoff" style="font-size: 8rem;"></i>
        </div>
        <div class="position-relative z-1">
            <span class="badge bg-white bg-opacity-25 text-white mb-2 px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px;">PERSONAL TASK MANAGER</span>
            <h1 class="display-6 fw-bold mb-2">Conquer your day, one task at a time.</h1>
            <p class="text-white-50 mb-4" style="max-width: 500px;">Organize, track, and complete your daily activities seamlessly.</p>
            <a href="{{ url('/tasks/create') }}" class="btn btn-light px-4 py-2 rounded-pill shadow fw-bold" style="color: #064e52;">
                <i class="bi bi-plus-circle me-1"></i> Create New Task
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-4" style="border-color: #064e52 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Total Tasks</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0">{{ $totalTasks ?? 0 }}</h3>
                    </div>
                    <div class="p-3 rounded-3" style="background-color: rgba(6, 78, 82, 0.1); color: #064e52;">
                        <i class="bi bi-list-task fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-warning border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">In Progress</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0">{{ $pendingTasks ?? 0 }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-success border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase" style="font-size: 11px;">Completed</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0">{{ $completedTasks ?? 0 }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Task List Container -->
    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-kanban me-2" style="color: #064e52;"></i>Task Actions & List</h5>
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill">{{ $totalTasks ?? 0 }} Items</span>
        </div>

        <div class="d-flex flex-column gap-3">
            @forelse ($tasks as $task)
                <div class="p-3 rounded-4 border bg-light bg-opacity-10 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="mt-1">
                            @if($task->status == 'Completed')
                                <span class="badge bg-success rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 24px; height: 24px;">
                                    <i class="bi bi-check text-white small"></i>
                                </span>
                            @else
                                <span class="border border-2 rounded-circle d-inline-block bg-white shadow-sm" style="width: 24px; height: 24px;"></span>
                            @endif
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1 {{ $task->status == 'Completed' ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $task->task_name }}
                            </h6>
                            <p class="text-muted small mb-2">{{ $task->description ?? 'No description provided.' }}</p>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                @if($task->status == 'Completed')
                                    <span class="badge bg-success text-white px-2 py-1 rounded-pill" style="font-size: 10px;">COMPLETED</span>
                                @else
                                    <span class="badge bg-warning text-dark px-2 py-1 rounded-pill" style="font-size: 10px;">PENDING</span>
                                @endif
                                <span class="text-muted small" style="font-size: 11px;">
                                    <i class="bi bi-calendar3 me-1"></i> Due: {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : 'No deadline' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-end align-self-end align-self-md-center">
                        <a href="{{ url('/tasks/' . $task->id . '/edit') }}" class="btn btn-sm px-3 rounded-pill fw-semibold" style="border-color: #064e52; color: #064e52;">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ url('/tasks/' . $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-3 rounded-pill fw-semibold">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-x display-4 text-secondary opacity-50"></i>
                    </div>
                    <p class="mb-2 fw-semibold">No tasks found in the list.</p>
                    <a href="{{ url('/tasks/create') }}" class="btn btn-sm text-white rounded-pill px-4 shadow-sm" style="background-color: #064e52;">Add a Task Now</a>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection