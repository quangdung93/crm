@push('javascript')
<script>
    $(document).ready(function(){
        @if(Session::has('success'))
            pushNotify('{{ Session::get('success') }}', text = '', type = 'success');
        @elseif(Session::has('danger'))
            pushNotify('{{ Session::get('danger') }}', text = '', type = 'danger');
        @endif
    });
</script>
@endpush