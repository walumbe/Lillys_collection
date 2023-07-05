@if(session()->has('success'))
    <div id="success-alert" class="alert alert-success alert-block text-center my-5">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session()->get('success') }}</strong>
    </div>
@endif

@if(session()->has('error'))
    <div id="error-alert" class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session()->get('error') }}</strong>
    </div>
@endif

<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
        $('#error-alert').fadeOut('slow');
    }, 3000);
</script>
