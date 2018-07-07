  <div class="col-sm-8" style="padding-top: 50px">
    <div class="panel panel-info">
      <div class="panel-heading">Add/Edit Author</div>
      <div class="panel-body" style="padding: 40px">
        <div class="alert alert-success" style="display: none;"></div>
        <form name="addeditauthor" id="addEditAuthor" action="" method="post">
          <input type="hidden" name="authorId" value="0">
          <div class="row">
            <div class="col-sm-7">
              <div class="form-group">
                <label for="authorname">Name :</label>
                <?php echo form_input(['class'=>'form-control','id'=>'authorname','placeholder'=>'Enter author name','name'=>'authorname','value'=>set_value('authorname')]); ?>
              </div>
            </div>
            <div class="col-sm-5">
              <div id="authornameError" style="color:red;margin-top: 30px"></div>
            </div>
          </div>
       <?php echo form_submit(['type'=>'button','class'=>'btn btn-success','id'=>'btnSave','value'=>'Submit']); ?>
       <?php echo form_reset(['type'=>'reset','class'=>'btn btn-danger','value'=>'Reset']); ?>
     </form>
   </div>
 </div>
</div>

<script>
  $(document).ready(function(){
    $("#btnSave").click(function(){
      if(formValidation() == '1')
      {
        var url = '<?php echo base_url() ?>author/insertUpdateAuthor';
        var data = $('#addEditAuthor').serialize();

      
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
              $('#addEditAuthor')[0].reset();
              if(response.type=='add')
              {
                var type = 'added'
              }
              else if(response.type=='update')
              {
                var type ="updated"
              }

              $('.alert-success').html('Author '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
            }
            else
            {
              alert('Error');
            }
          }

      });
  }

});
});



  function formValidation()
  {
    var authorName = document.getElementById("authorname").value;

    var flag = '';
    if(!authorName=="")
    {
      var regex = /^[A-Za-z\s]+$/;
      if(!regex.test(authorName))
      {
        $('#authorname').css({"border":"1px solid red"});
        document.getElementById("authornameError").innerHTML="Name should contain only alphabets.";
        $('#authornameError').css({"display":"block"});
      }
      else
      {
       $('#authorname').css("border",'');
       $('#authornameError').css({"display":"none"});
       flag +='1';
     }
   }
   else
   {
    $('#authorname').css({"border":"1px solid red"});
    document.getElementById("authornameError").innerHTML="Please enter name.";
  }

return flag;
}
</script>


