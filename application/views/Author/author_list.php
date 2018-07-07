<div class="col-sm-8" style="padding-top: 50px">
 <div class="panel panel-info">
  <div class="panel-heading">All Author List</div>
  <div class="panel-body">  

    <div class="alert alert-success" style="display: none;"></div>

    <table id="authorList" class="table table-hover table-bordered">
      <thead style="background-color: #87b3c3;color: white;">
        <tr>
          <th>Sl.No.</th>
          <th>Name</th>
          <th>Entry Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="showAuthorData">

      </tbody>
    </table>
  </div>
</div>
</div>


<Script>
  $(document).ready(function(){
   $('#authorList').DataTable();

   showAllAuthors(); //function to fetch & display all author data

   //delete start
   $('#showAuthorData').on('click', '.item-delete', function(){
    var id = $(this).attr('data');
    $('#deleteModal').modal('show');
      //prevent previous handler - unbind()
      $('#btnDelete').unbind().click(function(){
        $.ajax({
          type: 'ajax',
          method: 'get',
          async: false,
          url: '<?php echo base_url() ?>author/delete_author',
          data:{id:id},
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#deleteModal').modal('hide');
              $('.alert-success').html('Author Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
              showAllAuthors();
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
});


  function showAllAuthors(){
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url() ?>author/author_list',
      async: false,
      dataType: 'json',
      success: function(data){

        var html = '';
        var i;
        var sl=1;
        for(i=0; i<data.length; i++){

          html +='<tr>'+
          '<td>'+ sl +'</td>'+
          '<td>'+data[i].author_name+'</td>'+
          '<td>'+data[i].entry_date+'</td>'+
          '<td>'+
          '<a href="<?php echo base_url(); ?>Author/fetch_author/'+data[i].author_id+'" class="btn btn-xs btn-primary" data="'+data[i].author_id+'">Edit</a>'+ " " +
          '<a href="javascript:;" class="btn btn-xs btn-danger item-delete" data="'+data[i].author_id+'">Delete</a>'+
          '</td>'+
          '</tr>';
          sl++;
        }
        $('#showAuthorData').html(html);
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
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
