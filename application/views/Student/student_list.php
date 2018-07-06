<div class="col-sm-8" style="padding-top: 50px">
 <div class="panel panel-info">
  <div class="panel-heading">All Student List</div>
  <div class="panel-body">  

    <div class="alert alert-success" style="display: none;"></div>

    <table id="studentList" class="table table-hover table-bordered">
      <thead style="background-color: #87b3c3;color: white;">
        <tr>
          <th>Sl.No.</th>
          <th>Name</th>
          <th>Department</th>
          <th>Roll No</th>
          <th>Reg No</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="showStudentData">

      </tbody>
    </table>
  </div>
</div>
</div>


<Script>
  $(document).ready(function(){
   $('#studentList').DataTable();

   showAllStudents(); //function to fetch & display all student data

   //delete start
   $('#showStudentData').on('click', '.item-delete', function(){
    var id = $(this).attr('data');
    $('#deleteModal').modal('show');
      //prevent previous handler - unbind()
      $('#btnDelete').unbind().click(function(){
        $.ajax({
          type: 'ajax',
          method: 'get',
          async: false,
          url: '<?php echo base_url() ?>student/delete_student',
          data:{id:id},
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#deleteModal').modal('hide');
              $('.alert-success').html('Student Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
              showAllStudents();
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('Error deleting');
          }
        });
      });
    });
 //delete end

 //edit start
 $('#showStudentData').on('click', '.item-edit', function(){
  var id = $(this).attr('data');
  $('#myModal').modal('show');
  $('#myModal').find('.modal-title').text('Edit Employee');
  //$('#myForm').attr('action', '<?php echo base_url() ?>employee/updateEmployee');
  $.ajax({
    type: 'ajax',
    method: 'get',
    url: '<?php echo base_url() ?>student/fetch_student',
    data: {id: id},
    async: false,
    dataType: 'json',
    success: function(data){
      $('input[name=txtId]').val(data.student_id);
      $('input[name=txtStudentName]').val(data.sname);
      $('select[name=dept]').val(data.department_id);
      $('input[name=txtRollNo]').val(data.roll);
      $('input[name=txtRegNo]').val(data.regno);
      $('input[name=txtPhone]').val(data.phone);
      $('input[name=txtEmail]').val(data.email);
    },
    error: function(){
      alert('Could not fetch Data');
    }
  });
});
//edit end

//update start
$("#btnUpdate").click(function(){
  if(formValidation() == '123456')
  {
       var url = '<?php echo base_url() ?>student/update_student';
        //alert(url);
        var data = $('#updateStudent').serialize();

      
        $.ajax({
          type: 'ajax',
          method: 'post',
          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response)
          {
            if(response.success)
            {
              $('#myModal').modal('hide');
              $('#updateStudent')[0].reset();
          
              if(response.type=='update')
              {
                var type ="updated"
              }
              $('.alert-success').html('Student '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
              showAllStudents();
            }
            else
            {
              alert('Error');
            }
          }

        });
      }

    });
//update end

});


  function showAllStudents(){
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url() ?>student/student_list',
      async: false,
      dataType: 'json',
      success: function(data){

        var html = '';
        var i;
        var sl=1;
        for(i=0; i<data.length; i++){

          html +='<tr>'+
          '<td>'+ sl +'</td>'+
          '<td>'+data[i].sname+'</td>'+
          '<td>'+data[i].department_name+'</td>'+
          '<td>'+data[i].roll+'</td>'+
          '<td>'+data[i].regno+'</td>'+
          '<td>'+data[i].phone+'</td>'+
          '<td>'+data[i].email+'</td>'+
          '<td>'+
          '<a href="javascript:;" class="btn btn-xs btn-primary item-edit" data="'+data[i].student_id+'">Edit</a>'+ " " +
          '<a href="javascript:;" class="btn btn-xs btn-danger item-delete" data="'+data[i].student_id+'">Delete</a>'+
          '</td>'+
          '</tr>';
          sl++;
        }
        $('#showStudentData').html(html);
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
  }



  function formValidation()
  {
    var studentName = document.getElementById("studentname").value;
    var studentDept = document.getElementById("dept").value;
    var studentRoll = document.getElementById("roll").value;
    var studentRegNo = document.getElementById("regno").value;
    var studentPhone = document.getElementById("phone").value;
    var studentEmail = document.getElementById("email").value;

    var flag = '';
    if(!studentName=="")
    {
      var regex = /^[A-Za-z\s]+$/;
      if(!regex.test(studentName))
      {
        $('#studentname').css({"border":"1px solid red"});
        document.getElementById("nameError").innerHTML="Name should contain only alphabets.";
        $('#nameError').css({"display":"block"});
      }
      else
      {
       $('#studentname').css("border",'');
       $('#nameError').css({"display":"none"});
       flag +='1';
     }
   }
   else
   {
    $('#studentname').css({"border":"1px solid red"});
    document.getElementById("nameError").innerHTML="Please enter name.";
  }


  if(studentDept=="")
  {
    $('#dept').css({"border":"1px solid red"});
    document.getElementById("deptError").innerHTML="Please select a department";
    $('#deptError').css({"display":"block"});
  }
  else
  {
   $('#dept').css("border",'');
   $('#deptError').css({"display":"none"});
   flag +='2';
 }


 if(!studentRoll=="")
 {
   var reg = /^\d+$/;
   if(!reg.test(studentRoll))
   {
    $('#roll').css({"border":"1px solid red"});
    document.getElementById("rollError").innerHTML="Roll should contain only numeric value.";
    $('#rollError').css({"display":"block"});
  }
  else
  {
   $('#roll').css("border",'');
   $('#rollError').css({"display":"none"});
   flag +='3';
 }

}
else
{
  $('#roll').css({"border":"1px solid red"});
  document.getElementById("rollError").innerHTML="Please enter roll";
}

if(studentRegNo=="")
{
  $('#regno').css({"border":"1px solid red"});
  document.getElementById("regnoError").innerHTML="Please enter reg no";
  $('#regnoError').css({"display":"block"});
}
else
{
 $('#regno').css("border",'');
 $('#regnoError').css({"display":"none"});
 flag +='4';
}


if(!studentPhone=="")
{
 var reg = /^\d+$/;
 if(!reg.test(studentPhone))
 {
  $('#phone').css({"border":"1px solid red"});
  document.getElementById("phoneError").innerHTML="Roll should contain only numeric value.";
  $('#phoneError').css({"display":"block"});
}
else
{
 $('#phone').css("border",'');
 $('#phoneError').css({"display":"none"});
 flag +='5';
}

}
else
{
  $('#phone').css({"border":"1px solid red"});
  document.getElementById("phoneError").innerHTML="Please enter phone";
}

if(!studentEmail=="")
{
 var positionOfAtTheRate=studentEmail.indexOf("@");
 var positionOfDot=studentEmail.lastIndexOf(".");

 if(positionOfAtTheRate<2 || positionOfAtTheRate+2>email.length || positionOfDot+2>email.length || positionOfAtTheRate<0 || positionOfDot<1||positionOfDot<positionOfAtTheRate)
 {
  $('#email').css({"border":"1px solid red"});
  document.getElementById("emailError").innerHTML="Invalid Email.";
  $('#emailError').css({"display":"block"});
}
else
{
 $('#email').css("border",'');
 $('#emailError').css({"display":"none"});
 flag +='6';
}

}
else
{
  $('#email').css({"border":"1px solid red"});
  document.getElementById("emailError").innerHTML="Please enter email";
}


return flag;
}
</script>


<!-- Delete Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #238a89fa;color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        Do you want to delete this record?
      </div>
      <div class="modal-footer" style="padding: 5px">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #238a89fa;color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
       <form name="updateStudent" id="updateStudent" action="" method="post" class="form-horizontal">
          <input type="hidden" name="txtId" value="0">
          <div class="form-group">
            <label for="name" class="label-control col-md-2">Name</label>
            <div class="col-md-6">
              <input type="text" name="txtStudentName" id="studentname" class="form-control">
               
            </div>
            <div class="col-md-4">
            <div id="nameError" style="color:red;margin-top: 10px"></div>
           </div>
          </div>
          <div class="form-group">
            <label for="dept" class="label-control col-md-2">Department</label>
            <div class="col-md-6">
             <select name="dept" id="dept" class="form-control">
              <option value="" selected>----Select----</option>
              <?php foreach ($deptdata as $row):?>
                <option value="<?php echo $row->department_id ?>">
                  <?php echo $row->department_name?>
                </option>
              <?php endforeach;?>
            </select>
          </div>
           <div class="col-md-4">
            <div id="deptError" style="color:red;margin-top: 10px"></div>
           </div>
        </div>
        <div class="form-group">
          <label for="roll" class="label-control col-md-2">Roll No</label>
          <div class="col-md-6">
            <input type="text" name="txtRollNo" id="roll" class="form-control">
            
          </div>
           <div class="col-md-4">
            <div id="rollError" style="color:red;margin-top: 10px"></div>
           </div>
        </div>
        <div class="form-group">
          <label for="regno" class="label-control col-md-2">Reg No</label>
          <div class="col-md-6">
            <input type="text" name="txtRegNo" id="regno" class="form-control">
             
          </div>
           <div class="col-md-4">
            <div id="regnoError" style="color:red;margin-top: 10px"></div>
           </div>
        </div>
        <div class="form-group">
          <label for="phone" class="label-control col-md-2">Phone</label>
          <div class="col-md-6">
            <input type="text" name="txtPhone" id="phone" class="form-control">
             
          </div>
          <div class="col-md-4">
            <div id="phoneError" style="color:red;margin-top: 10px"></div>
           </div>
        </div>
        <div class="form-group">
          <label for="email" class="label-control col-md-2">Email</label>
          <div class="col-md-6">
            <input type="text" name="txtEmail" id="email" class="form-control">
             <div id="emailError" style="color:red;margin-top: 10px"></div>
          </div>
          <div class="col-md-4">
            <div id="phoneError" style="color:red;margin-top: 10px"></div>
           </div>
        </div>
      </form>
    </div>
    <div class="modal-footer" style="padding: 5px">
      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      <button type="button" id="btnUpdate" class="btn btn-success">Update Changes</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->