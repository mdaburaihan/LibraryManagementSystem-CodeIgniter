<div class="col-sm-8" style="padding-top: 50px">
 <div class="panel panel-info">
  <div class="panel-heading">All Department List</div>
  <div class="panel-body">  
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
  <table id="deptList" class="table table-hover table-bordered">
    <thead style="background-color: #87b3c3;color: white;">
      <tr>
        <th>SL. No.</th>
        <th>Department</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($departments))
      {
        $sl=1;
        foreach ($departments as $dept) 
        {
          ?>
      <tr>
        <td><?php echo $sl++; ?></td>
        <td><?php echo $dept->department_name; ?></td>
        <td><?php echo $dept->entry_date; ?></td>
        <td>
        <?= anchor("department/fetch_Department/{$dept->department_id}",'Edit',['class'=>'btn btn-xs btn-primary']) ?>
        </td>
         <td>
        <?= anchor("department/fetch_Department/{$dept->department_id}",'Delete',['class'=>'btn btn-xs btn-danger']) ?>
        </td>
      </tr>
      <?php
        }
      }
      else
      {
        ?>
        <tr>
          <td colspan="2">No Data Available</td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
</div>
</div>

<Script>
  $(document).ready(function(){
   $('#deptList').DataTable();
   });
</script>

