$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	hideAllAlerts();
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

var  openEditModel = function (id){
	hideAllAlerts();
	$("#editEmail").val($("#email"+id).html());
	$("#editName").val($("#name"+id).html());
	$("#editPhone").val($("#phone"+id).html());
	$("#editAddress").val($("#address"+id).html());
	$("#editId").val(id);
	
}

var hideAllAlerts = function(){
	$("#successAlert").hide();
	$("#errorAlert").hide();
}

var addEmployee = function(){
	hideAllAlerts();
	$.post("save_userinput",
  {
    name: $("#name").val(),
	email:$("#email").val(),
	phone: $("#phone").val(),
	address: $("#address").val()
  },
  function(data, status){
   if(data.success == true){
		addNewRowRecords(data.id);
		$("#successAlert").show();
		$("#successAlertBody").html(data.msg);
   } else{
		$("#errorAlert").show();
		$("#errorAlertBody").html("Unable to create employee record.");
   }
  });
}


var addNewRowRecords = function(id){
	$('#employeeTable tr:last').after(` <tr>
			<td>
				<span class="custom-checkbox">
					<input type="checkbox"  id="`+id+`" name="options[]" >
					<label for="checkbox1"></label>	
				</span>
			</td>
			<td id="name`+id+`">`+$("#name").val()+`</td>
			<td id="email`+id+`">`+$("#email").val()+`</td>
			<td id="address`+id+`">`+$("#address").val()+`</td>
			<td id="phone`+id+`">`+$("#phone").val()+`</td>
			<td>
				<a href="#editEmployeeModal" class="edit" onClick = "openEditModel(`+id+`)" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
				<a href="#deleteEmployeeModal" onClick="deleteEmployee(`+id+`) class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
			</td>
		</tr>`);
}
var editEmployee = function(){
	hideAllAlerts();
	$.post("update_employee",
  {
    name: $("#editName").val(),
	email:$("#editEmail").val(),
	phone: $("#editPhone").val(),
	address: $("#editAddress").val(),
	id: $("#editId").val()
  },
  function(data, status){
   if(data.success == true){
	changeEmployeeRecords($("#editId").val());
	$("#successAlert").show();
	$("#successAlertBody").html(data.msg);
   } else{
	$("#errorAlert").show();
	$("#errorAlertBody").html("Unable to update employee record.");
   }
  });
	   
}

var changeEmployeeRecords = function (id){
	$("#email"+id).html($("#editEmail").val());
	$("#name"+id).html($("#editName").val());
	$("#phone"+id).html($("#editPhone").val());
	$("#address"+id).html($("#editAddress").val());
	
}

var deleteSingleEmployee = function (id){
	var checkbox = $('table tbody input[type="checkbox"]');
	checkbox.each(function(){
		console.log(this.id);
		if(this.id== id){
		this.checked = true;
		}                        
	});
}

var deleteEmployees = function (){
	hideAllAlerts();
	var checkbox = $('table tbody input[type="checkbox"]');
	var ids = '';
	var count = 0;
	checkbox.each(function(){
		if(this.checked){
			count++;
			ids+=this.id+',';
		}
	});
	if(count==0){
		alert('Please select atleast one checkbox');
	}else{
		
		$.post("delete_employees",
	  {
		ids: ids
	  },
	  function(data, status){
	   if(data.success == true){
		removeEmployeeRecoredsFromTable(ids);
		$("#successAlert").show();
		$("#successAlertBody").html(data.msg);
	   } else{
		$("#errorAlert").show();
		$("#errorAlertBody").html("Unable to Delete employee record.");
	   }
	  });
	}

	var removeEmployeeRecoredsFromTable = function (){
		var res = ids.split(",");
		$.each(res, function( index, value ) {
			$('#'+value).remove();
		  });
	}
	
}