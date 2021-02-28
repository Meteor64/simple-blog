@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ session('success') }}",
        })
    </script>
@endif

@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            text: "{{ session('warning') }}",
        })
    </script>
@endif
