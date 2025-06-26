
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Signatories</h4>
      </div>
     @if (empty($signatories))
      <br>  
      <p class="text-danger text-center">No signatories have been set. Please fill out the form below.</p>
     @endif
      <div class="modal-body">
        <form id="prepared_by_form">
          <div class="form-group row align-items-end">
            <div class="col-md-6">
              <label for="prepared_by">Prepared by</label>
              <input id="prepared_by" name="prepared_by" type="text" class="form-control" value="">
            </div>
            <div class="col-md-4">
              <label for="prepared_by_position">Position</label>
              <input id="prepared_by_position" name="prepared_by_position" type="text" class="form-control" value="">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form id="recommending_approval_form">
          <div class="form-group row align-items-end">
            <div class="col-md-6">
              <label for="recommending_approval">Recommending Approval</label>
              <input id="recommending_approval" name="recommending_approval" type="text" class="form-control" value="">
            </div>
            <div class="col-md-4">
              <label for="recommending_approval_position">Position</label>
              <input id="recommending_approval_position" name="recommending_approval_position" type="text" class="form-control" value="">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form id="approved_form">
          <div class="form-group row align-items-end">
            <div class="col-md-6">
              <label for="approved">Approved</label>
              <input id="approved" name="approved" type="text" class="form-control" value="">
            </div>
            <div class="col-md-4">
              <label for="approved_position">Position</label>
              <input id="approved_position" name="approved_position" type="text" class="form-control" value="">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form id="conforme_form">
          <div class="form-group row align-items-end">
            <div class="col-md-6">
              <label for="conforme">Conforme</label>
              <input id="conforme" name="conforme" type="text" class="form-control" value="">
            </div>
            <div class="col-md-4">
              <label for="conforme_position">Position</label>
              <input id="conforme_position" name="conforme_position" type="text" class="form-control" value="">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" onclick='return confirm("Clicking the OK button will modify the record? Do you wish to continue?")' class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

<script>
  $('#prepared_by_form').on('submit', function(e) {
    e.preventDefault();
    var preparedBy = $('#prepared_by').val();
    var preparedByPosition = $('#prepared_by_position').val();
    var csrfToken = $('input[name="_token"]').val();

    $.ajax({
      type: 'POST',
      url: '/ajax/admin/reports/update_preparedby',
      data: {
        _token: csrfToken,
        prepared_by: preparedBy,
        prepared_by_position: preparedByPosition
      },
      success: function(response) {
        alert('Prepared by updated successfully!');
      },
      error: function(xhr, status, error) {
        console.error('Error updating prepared by:', error);
      }
    });
  });


  $('#recommending_approval_form').on('submit', function(e) {
    e.preventDefault();
    var recommending_approval = $('#recommending_approval').val();
    var recommending_approval_position = $('#recommending_approval_position').val();
    var csrfToken = $('input[name="_token"]').val();

    console.log('recommending_approval:', recommending_approval);
    console.log('recommending_approval_position:', recommending_approval_position);
    
    $.ajax({
      type: 'POST',
      url: '/ajax/admin/reports/update_recommendingapproval',
      data: {
        _token: csrfToken,
        recommending_approval: recommending_approval,
        recommending_approval_position: recommending_approval_position
      },
      success: function(response) {
        alert('Prepared by updated successfully!');
      },
      error: function(xhr, status, error) {
        console.error('Error updating prepared by:', error);
      }
    });
  });

  $('#approved_form').on('submit', function(e) {
    e.preventDefault();
    var approved = $('#approved').val();
    var approved_position = $('#approved_position').val();
    var csrfToken = $('input[name="_token"]').val();

    $.ajax({
      type: 'POST',
      url: '/ajax/admin/reports/update_approved',
      data: {
        _token: csrfToken,
        approved: approved,
        approved_position: approved_position
      },
      success: function(response) {
        alert('Prepared by updated successfully!');
      },
      error: function(xhr, status, error) {
        console.error('Error updating prepared by:', error);
      }
    });
  });

  $('#conforme_form').on('submit', function(e) {
    e.preventDefault();
    var conforme = $('#conforme').val();
    var conforme_position = $('#conforme_position').val();
    var csrfToken = $('input[name="_token"]').val();

    $.ajax({
      type: 'POST',
      url: '/ajax/admin/reports/update_conforme',
      data: {
        _token: csrfToken,
        conforme: conforme,
        conforme_position: conforme_position
      },
      success: function(response) {
        alert('Prepared by updated successfully!');
      },
      error: function(xhr, status, error) {
        console.error('Error updating prepared by:', error);
      }
    });
  });
</script>