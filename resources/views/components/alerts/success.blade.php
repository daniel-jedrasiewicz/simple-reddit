@if (\Session::has('success'))
    <div class="col-12" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        <div class="alert alert-success custom-alert-success">
            <i class="icon fa-regular fa-circle-check"></i>
            <div class="content">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
@endif
