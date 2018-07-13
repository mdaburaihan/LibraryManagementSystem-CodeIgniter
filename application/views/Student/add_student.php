  <div class="col-sm-8" style="padding-top: 50px">
    <div class="panel panel-info">
      <div class="panel-heading">Add Student</div>
      <div class="panel-body" style="padding: 40px">
        <div class="alert alert-success" style="display: none;"></div>
        <form name="addStudent" id="addStudent" action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-7">
              <div class="form-group">
                <label for="sname">Name :</label>
                <?php echo form_input(['class'=>'form-control','id'=>'studentname','placeholder'=>'Enter student name','name'=>'studentname','value'=>set_value('sname')]); ?>
              </div>
            </div>
            <div class="col-sm-5">
              <div id="nameError" style="color:red;margin-top: 30px"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <div class="form-group">
                <label for="dept">Department :</label>
             <!-- <?php 
              echo form_dropdown('dept', $depart,'','class="form-control"');
              ?> -->
              <select name="dept" id="dept" class="form-control">
                <option value="" selected>----Select----</option>
                <?php foreach ($deptdata as $row):?>
                  <option value="<?php echo $row->department_id ?>">
                    <?php echo $row->department_name?>
                  </option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="col-sm-5">
            <div id="deptError" style="color:red;margin-top: 30px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7">
            <div class="form-group">
              <label for="roll">Roll No :</label>
              <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter roll no','name'=>'roll','id'=>'roll','value'=>set_value('roll')]); ?>
            </div>
          </div>
          <div class="col-sm-5">
            <div id="rollError" style="color:red;margin-top: 30px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7">
            <div class="form-group">
              <label for="regno">Reg No :</label>
              <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter reg no','name'=>'regno','id'=>'regno','value'=>set_value('regno')]); ?>
            </div>
          </div>
          <div class="col-sm-5">
            <div id="regnoError" style="color:red;margin-top: 30px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7">
            <div class="form-group">
              <label for="phone">Phone No :</label>
              <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter phone no','name'=>'phone','id'=>'phone','value'=>set_value('phone')]); ?>
            </div>
          </div>
          <div class="col-sm-5">
            <div id="phoneError" style="color:red;margin-top: 30px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7">
            <div class="form-group">
              <label for="email">Email :</label>
              <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter email','name'=>'email','id'=>'email','value'=>set_value('email')]); ?>
            </div>
          </div>
          <div class="col-sm-5">
           <div id="emailError" style="color:red;margin-top: 30px"></div>
         </div>
       </div>
       <div class="row">
        <div class="col-sm-7">
          <div class="form-group">
            <label for="image">Image :</label>
            <?php echo form_upload(['class'=>'form-control','name'=>'pic','id'=>'pic']); ?>
            <span class="help-block" style="color: red">*Allowed File Type - jpg, jpeg, png</span>  
          </div>
        </div>
        <div class="col-sm-5">
         <div id="ImageError" style="color:red;margin-top: 30px"></div>
       </div>
     </div>
     <div class="row">
      <div class="col-sm-12">
       <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success','id'=>'btnSave','value'=>'Submit']); ?>
       <?php echo form_reset(['type'=>'reset','class'=>'btn btn-danger','value'=>'Reset']); ?>
     </div>
   </div>
 </form>
</div>
</div>
</div>

<script>
  $(document).ready(function(e){
    $("#addStudent").on('submit', function(e){
      e.preventDefault();

      if(formValidation() == '1234567')
      {
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url() ?>student/insertStudent',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          beforeSend: function(){
            $('#btnSave').attr("disabled","disabled");
            $('#addStudent').css("opacity",".5");
          },
          success: function(response){
            if(response.msg_code==1)
            {
              $('#addStudent')[0].reset();
              $('.alert-success').html(response.msg_data).fadeIn().delay(4000).fadeOut('slow');
            }
            else if(response.msg_code==2)
            {
              $('.alert-danger').html(response.msg_data).fadeIn().delay(4000).fadeOut('slow');
            }
            else if(response.msg_code==3)
            {
              $('.alert-danger').html(response.msg_data).fadeIn().delay(4000).fadeOut('slow');
            }  
            else
            {
              alert('Error');
            }

            $('#addStudent').css("opacity","");
            $("#btnSave").removeAttr("disabled");
          }
        });
      }
    });
    
    //file type validation
   /* $("#pic").change(function() {
        var pic = this.files[0];
        var imagefile = pic.type;
        var match= ["image/jpeg","image/png","image/jpg"];

        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#pic").val('');
            return false;
        }
      });*/
    });




  function formValidation()
  {
    var studentName = document.getElementById("studentname").value;
    var studentDept = document.getElementById("dept").value;
    var studentRoll = document.getElementById("roll").value;
    var studentRegNo = document.getElementById("regno").value;
    var studentPhone = document.getElementById("phone").value;
    var studentEmail = document.getElementById("email").value;
    var studentImg = document.getElementById("pic").value;

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


  if(!studentImg=="")
  {
     var extn = studentImg.split('.').pop();
     //alert(extn);
     var match= ["jpeg","png","jpg"];

     if(!((extn==match[0]) || (extn==match[1]) || (extn==match[2])))
     {
       $('#pic').css({"border":"1px solid red"});
      document.getElementById("ImageError").innerHTML="Please select a valid image file (JPEG/JPG/PNG).";
      $('#ImageError').css({"display":"block"});
      $("#pic").val('');
     }
     else
     {
       $('#pic').css("border",'');
       $('#ImageError').css({"display":"none"});
       flag +='7';
     }
     
  }
  else 
  {
    $('#pic').css({"border":"1px solid red"});
    document.getElementById("ImageError").innerHTML="Please upload image";
  }


  return flag;
  }
  </script>


