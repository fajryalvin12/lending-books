@extends('adminlte::page')

@section('title', 'Books')

@section('content_header')
    <h1>Books Management</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary">+ Add Book</button>
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="booksTable">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- nanti diisi AJAX DataTables --}}
                </tbody>
            </table>
        </div>
    </div>

@section('js')
<script>
    console.log('Books page ready for DataTables 🚀');
</script>
@stop

