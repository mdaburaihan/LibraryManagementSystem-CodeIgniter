<div class="col-sm-8" style="padding-top: 50px">
  <div class="panel panel-info">
    <div class="panel-heading">Edit Department</div>
    <div class="panel-body" style="padding: 40px">
      <?php
      if($flashmsg=$this->session->flashdata('msg'))
      {
        $msg_class=$this->session->flashdata('msg_class');
        ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="alert <?= $msg_class ?>">
              <?php echo $flashmsg; ?>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
     <?php echo form_open("department/update_department/{$dpt->department_id}"); ?>

      <?php echo form_error("dept"); ?>

      <div class="form-group">
        <label for="department">Department :</label>
        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter departmnent name','name'=>'dept','value'=>set_value('dept',$dpt->department_name)]); ?>
      </div>
      <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success','value'=>'Update']); ?>
      <?= anchor("department/department_list",'Back',['class'=>'btn btn-primary']) ?>

    </div>
  </div>
</div>



