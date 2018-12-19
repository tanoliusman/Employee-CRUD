<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>employee.css">
<script type='text/javascript' src="<?php echo base_url('js/employee.js'); ?>"></script>


</head>
<body>
<?php

$query = $this->db->query("select * from employee");

?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
			<div id="successAlert" class="alert alert-success">
				<strong>Success!</strong> <p id="successAlertBody">Indicates a successful or positive action.</p>
			</div>
			<div id="errorAlert" class="alert alert-danger">
				<strong>Failure!</strong> <p id="errorAlertBody" >Indicates a dangerous or potentially negative action.</p>
			</div>
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Employees</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table id="employeeTable" class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Name</th>
                        <th>Email</th>
						<th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
				foreach ($query->result() as $row)
				{
					
				?>
                    <tr id="<?php echo $row->id?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox"  id="<?php echo $row->id?>" name="options[]" >
								<label for="checkbox1"></label>	
							</span>
						</td>
                        <td id="name<?php echo $row->id?>"><?php echo $row->name?></td>
                        <td id="email<?php echo $row->id?>"><?php echo $row->email?></td>
						<td id="address<?php echo $row->id?>"><?php echo $row->address?></td>
                        <td id="phone<?php echo $row->id?>"><?php echo $row->phone?></td>
                        <td>
							<a href="#editEmployeeModal" class="edit" onClick = "openEditModel(<?php echo $row->id?>)" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" onClick = "deleteSingleEmployee(<?php echo $row->id?>)" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
					<?php 
				}
					?>
                </tbody>
            </table>
			<!-- <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div> -->
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" name="address" id="address" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" id="phone" name="phone" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-success" data-dismiss="modal" value="Add" onClick="addEmployee()">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="editName" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="editEmail" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" id="editAddress" name="address" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" id="editPhone" name="phone" class="form-control" required>
							<input type="hidden" id="editId" name="id">
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-info" data-dismiss="modal" onClick="editEmployee()" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					
					<div class="modal-footer">
						<input type="button" class="btn btn-default"  data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-danger"  data-dismiss="modal" onClick = "deleteEmployees()" value="Delete">
					</div>
				
			</div>
		</div>

		
	</div>
</body>
</html>                                		                            