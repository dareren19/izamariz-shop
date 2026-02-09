{{-- @props([
    'type' => 'success',
    'title' => '',
    'text' => '',
    'timer' => 3000,
    'showConfirmButton' => false,
    'toast' => true,
    'position' => 'top-end'
])

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const Toast = Swal.mixin({
        toast: {{ $toast ? 'true' : 'false' }},
        position: '{{ $position }}',
        showConfirmButton: {{ $showConfirmButton ? 'true' : 'false' }},
        timer: {{ $timer }},
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: '{{ $type }}',
        title: '{{ $title }}',
        text: '{{ $text }}'
    });
});
</script>
@endpush --}}