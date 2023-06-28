
@if(session()->has ('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close"data-dismiss="alert">×</button>
       <strong> {{ session()->get('success') }}</strong>
    </div>

    @if(session()->has ('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close"data-dismiss="alert">×</button>
       <strong> {{ session()->get('success') }}</strong>
    </div>
@endif