@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <!-- Header na may Custom Teal Gradient -->
        <div class="text-white py-4 px-4 border-0" style="background: linear-gradient(135deg, #064e52 0%, #00838f 100%);">
            <h4 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Add New Task</h4>
            <p class="text-white-50 small mb-0 mt-1">Fill in the details below to create a new task for your workspace.</p>
        </div>

        <div class="card-body p-4 p-md-5">
            @if ($errors->any())
                <div class="alert alert-danger rounded-4 shadow-sm border-0 mb-4">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/tasks') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="task_name" class="form-label fw-semibold text-dark">Task Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill py-2 px-3 border-secondary border-opacity-25 shadow-sm" id="task_name" name="task_name" value="{{ old('task_name') }}" placeholder="e.g., Study Laravel framework" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold text-dark">Description</label>
                    <textarea class="form-control rounded-4 p-3 border-secondary border-opacity-25 shadow-sm" id="description" name="description" rows="4" placeholder="Enter task description or notes here...">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="form-label fw-semibold text-dark">Due Date</label>
                    <input type="date" class="form-control rounded-pill py-2 px-3 border-secondary border-opacity-25 shadow-sm" id="due_date" name="due_date" value="{{ old('due_date') }}">
                </div>

                <div class="d-flex justify-content-end gap-2 pt-2">
                    <a href="{{ url('/tasks') }}" class="btn btn-light px-4 py-2 rounded-pill border fw-semibold">Cancel</a>
                    <button type="submit" class="btn text-white px-4 py-2 rounded-pill shadow-sm fw-semibold" style="background-color: #064e52;">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection