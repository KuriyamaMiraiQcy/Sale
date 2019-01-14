<html>

<head>

<title>Crud APP using Codeigniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>

<div class="container">
<h2>CodeIgniter CRUD Application using Bootstrap</h2>

    <button class="btn btn-success" onclick="add_book()">Add Book</button>

	<div>
		<form id="search_form" action="#" class="form-inline">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3">BookISBN</label>
					<div class="col-md-9">
						<input type="num" name="search_book_isbn" class="form-control" required="">
					</div>
				</div>
			</div>
			<button class="btn btn-toolbar">Search</button>
		</form>

	</div>
    <table class="table table-bordered" id="table_id">
        <thead>
        <th>Book ID</th>
        <th>Book ISBN</th>
        <th>Book Title</th>
        <th>Book Author</th>
        <th>Book Category</th>
        <th>Action</th>

        </thead>

        <tbody>
		<?php foreach($books as $book)
		{ ?>
        	<tr>
            	<td><?php echo $book->book_id; ?></td>
            	<td><?php echo $book->book_isbn; ?></td>
            	<td><?php echo $book->book_title; ?></td>
            	<td><?php echo $book->book_author; ?></td>
            	<td><?php echo $book->book_category; ?></td>
            	<td><button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id?>)">Edit</button>
					<button class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id?>)">Delete</button>
				</td>

        	</tr>
		<?php } ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.js"></script>


<script type="text/javascript">
	$(document).ready(function () {
		$('#table_id').DataTable();
	})
	var save_method;

    function f() {

	}

	function add_book() {
    	save_method = "add";
        $('#modal_form').modal('show');
    }

    function edit_book(id) {
		save_method = "update";
		$.ajax({
			url: "<?php echo base_url('index.php/crud/ajax_edit');?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data)
			{
				$('[name = "book_id"]').val(data.book_id);
				$('[name = "book_isbn"]').val(data.book_isbn);
				$('[name = "book_title"]').val(data.book_title);
				$('[name = "book_author"]').val(data.book_author);
				$('[name = "book_category"]').val(data.book_category);

				$('#modal_form').modal('show');
				$('.modal-title').text('update book');
			}
		})
	}

	function delete_book(id) {
    	$.ajax({
			url: "<?php echo base_url('index.php/crud/book_delete');?>/" + id,
			type: "POST",
			dataType: "JSON",
			success: function (data) {
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("Error deleting data");
			}
		});
	}
    
    function save() {
    	if (save_method==="add")
		{
			var url = "<?php echo base_url()?>index.php/crud/book_add";
		}
		if (save_method==="update")
		{
			var url = "<?php echo base_url()?>index.php/crud/book_update";
		}
        // ajax code to add data to the database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                $('#modal_form').modal('hide');
                location.reload();
            },
            error: function (jqXHR,textStatus,errorThrown) {
                alert("Something Wrong, error adding/updating data");
            }
        });
    }


</script>



<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Book</h3>
            </div>
            <div class="modal-body form">


                <form id="form" action="#" class="form-horizontal">
					<input type="hidden" name="book_id">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3">Book ISBN</label>
                            <div class="col-md-9">
                                <input type="num" name="book_isbn" class="form-control" required="">
                            </div>
                        </div>

                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3">Book Title</label>
                            <div class="col-md-9">
                                <input type="num" name="book_title" class="form-control" required="">
                            </div>
                        </div>

                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3">Book Author</label>
                            <div class="col-md-9">
                                <input type="num" name="book_author" class="form-control" required="">
                            </div>
                        </div>

                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3">Book Category</label>
                            <div class="col-md-9">
                                <input type="num" name="book_category" class="form-control" required="">
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="btnSave" type="button" onclick="save()">Save</button>
                <button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>

            </div>

        </div>
    </div>

</div>

</body>

</html>
