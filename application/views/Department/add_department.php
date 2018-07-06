<div class="col-sm-8" style="padding-top: 50px">
  <div class="panel panel-info">
    <div class="panel-heading">Add New Department</div>
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
      <?php echo form_open("department/insertDepartment"); ?>

      <?php echo form_error("dept"); ?>

      <div class="form-group">
        <label for="department">Department :</label>
        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter departmnent name','name'=>'dept','value'=>set_value('dept')]); ?>
      </div>
      <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success','value'=>'Submit']); ?>
      <?php echo form_reset(['type'=>'reset','class'=>'btn btn-danger','value'=>'Reset']); ?>

    </div>
  </div>
</div>




