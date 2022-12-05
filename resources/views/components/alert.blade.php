@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <i class="bx bxs-message-rounded-check text-primary"></i>
        <strong class="text-primary">{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible">
        <i class="bx bxs-message-rounded-x"></i>
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="bx bxs-like text-primary"></i>
        <strong class="text-primary">{{ session('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
