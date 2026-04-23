@extends('adminlte::page')

@section('title', 'Books')

@section('content_header')
    <h1>Books Management</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')

    <!-- Dashboard Content -->
    <div class="card">
        <div class="card-header">
            <button id="addBook" class="btn btn-primary">+ Add Book</button>
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
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reusable Modal -->
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="bookcode" class="form-label">Bookcode</label>
                            <input type="text" class="form-control" id="bookcode" placeholder="Bookcode">
                            </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" placeholder="Author">
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" placeholder="Year">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="stock" placeholder="Stock">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="close-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="submit-data" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        let table;
        let mode = ""
        let selectedBookCode = ""

        // retrieve the books API data
        $(document).ready(function() {
            console.log("mode : ", mode)
            table = $('#booksTable').DataTable({
                ajax: '/admin/books/data',
                columns: [
                    { data: 'bookcode' },
                    { data: 'title' },
                    { data: 'author' },
                    { data: 'year' },
                    { data: 'stock' },
                    {
                        data: null,
                        render: function(data) {
                            
                            return `
                                <button data-code=${data.bookcode} class="btn btn-sm btn-warning btn-edit">Edit</button>
                                <button data-code=${data.bookcode} class="btn btn-sm btn-danger btn-delete">Delete</button>
                            `;
                        }
                    }
                ]
            });

        });

        // handling add new books 
        $('#addBook').click(function() {
            $('.modal').show()
            $('.modal-title').text("Add New Book")
            mode = "add"
        })
        $('#close-modal').click(function() {
            $('.modal').hide()
        })

        // submit data new book 
        $('#submit-data').click(function () {
            let objData = {
                bookcode: document.getElementById('bookcode').value,
                title: document.getElementById('title').value,
                author: document.getElementById('author').value,
                year: document.getElementById('year').value,
                stock: document.getElementById('stock').value
            }

            if (mode === 'add') {
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    data: objData,
                    url: "http://127.0.0.1:8000/api/books",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert(result.message)
                        $('.modal').hide()
                        table.ajax.reload()
                    }
                })
            } else if (mode === 'edit') {
                $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    data: objData,
                    url: `http://127.0.0.1:8000/api/books/${selectedBookCode}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert(result.message)
                        $('.modal').hide()
                        table.ajax.reload()
                    }
                })
            }
        })

        // edit / delete existing data book
        $('#booksTable').on('click', "button[data-code]", function(event) {
            event.preventDefault();

            selectedBookCode = $(this).attr("data-code")
            const edit = $(this).hasClass("btn-edit")
            const remove = $(this).hasClass("btn-delete")
            mode = "edit"
            console.log("mode at edit scope : ", mode)
            console.log("selectedcode at edit scope : ", selectedBookCode)

            // edit section
            if (edit) {
                console.log("edit button clicked")
                
                // retrieve book data by book-code 
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: `http://127.0.0.1:8000/api/books/${selectedBookCode}`,
                    success: function(result) {
                        const data = result.data
                        console.log("selected book : ", data)

                        for (const key in data) {
                            $(`#${key}`).val(data[key])
                        }
                        
                    }
                })

                // show the modal 
                $('.modal').show()
                $('.modal-title').text("Edit Selected Book")

                
            } else if (remove) {
                console.log("remove button clicked")
                selectedBookCode = $(this).attr("data-code")
                console.log("selectedcode at delete scope : ", selectedBookCode)

                // retrieve book data by book-code 
                $.ajax({
                    type: 'DELETE',
                    dataType: 'json',
                    url: `http://127.0.0.1:8000/api/books/${selectedBookCode}`,
                    success: function(result) {
                        alert(result.message)
                        $('.modal').hide()
                        table.ajax.reload()
                    }
                })
            }
        })
        
    </script>
@stop

