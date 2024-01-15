@if ($message = Session::get('success'))
<div class="row justify-content-center flash-message">
    <div class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="row justify-content-center flash-message">
    <div class="alert alert-danger alert-dismissible fade show col-md-8" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="row justify-content-center flash-message"> 
    <div class="alert alert-warning alert-dismissible fade show col-md-8" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

@endif

@if ($message = Session::get('info'))
<div class="row justify-content-center flash-message">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="row justify-content-center flash-message">
    <div class="alert alert-danger alert-dismissible fade show col-md-8" role="alert">
        <strong>Please check the form below for errors</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif