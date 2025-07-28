@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">My Cars</h2>
                <a href="{{ route('cars.create') }}" class="btn btn-orange">
                    <i class="fas fa-plus me-2"></i>Add new Car
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if($cars->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cars as $car)
                                        <tr>
                                            <td>
                                                @if($car->main_image)
                                                    <img src="{{ $car->main_image }}" 
                                                         alt="{{ $car->brand }} {{ $car->model }}" 
                                                         class="rounded" 
                                                         style="width: 60px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px; background-color: #f8f9fa; color: #6c757d;">
                                                        <i class="fas fa-car"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $car->year }} - {{ $car->brand }} {{ $car->model }}</div>
                                                <div class="text-muted small">{{ $car->formatted_price }}</div>
                                            </td>
                                            <td>{{ $car->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <span class="badge {{ $car->is_published ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $car->is_published ? 'Published' : 'Draft' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('cars.show', $car->id) }}" 
                                                       class="btn btn-sm btn-outline-primary" 
                                                       title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('cars.edit', $car->id) }}" 
                                                       class="btn btn-sm btn-outline-secondary" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('cars.manage-images', $car->id) }}" 
                                                       class="btn btn-sm btn-outline-info" 
                                                       title="Manage Images">
                                                        <i class="fas fa-images"></i>
                                                    </a>
                                                    <form action="{{ route('cars.destroy', $car->id) }}" 
                                                          method="POST" 
                                                          class="d-inline" 
                                                          onsubmit="return confirm('Are you sure you want to delete this car?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger" 
                                                                title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $cars->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="text-muted mb-3">
                                <i class="fas fa-car fa-3x"></i>
                            </div>
                            <h5 class="text-muted">You don't have any cars yet.</h5>
                            <a href="{{ route('cars.create') }}" class="btn btn-orange mt-3">
                                <i class="fas fa-plus me-2"></i>Add new car
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-orange {
    background-color: #F26522;
    border-color: #F26522;
    color: white;
}

.btn-orange:hover {
    background-color: #d54d1a;
    border-color: #d54d1a;
    color: white;
}

.btn-outline-orange {
    color: #F26522;
    border-color: #F26522;
}

.btn-outline-orange:hover {
    background-color: #F26522;
    border-color: #F26522;
    color: white;
}
</style>
@endsection 