@if (session($key ?? 'status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session($key ?? 'status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif