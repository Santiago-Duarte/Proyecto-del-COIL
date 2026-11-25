@extends('adminlte::page')

@section('title', 'VetControl')

@section('content_header')
    <h1 class="m-0" style="font-size: 1.5rem; font-weight: 600;">@yield('page_title')</h1>
@stop

@section('content')
    @yield('content_body')
@stop

@section('js')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif
@stop
