<!-- Button to Open the Modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> -->
  <!-- Open modal -->
<!-- </button> -->

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DELETE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h5 id="msg"> Are You Sure You Want To Delete ?</h5>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="" class="btn btn-danger modal_delete_link">Delete</a>
        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Save Model -->


<div class="modal" id="saveModel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="save-modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h5 id="save-msg"></h5>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="" class="btn btn-success modal_done_link">Done</a>
       <!--  <button type="button" class="btn btn-success" id="close" data-dismiss="modal">Done</button> -->
      </div>

    </div>
  </div>
</div>
