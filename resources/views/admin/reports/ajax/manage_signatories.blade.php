
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
        <form enctype="multipart/form-data" id="prepared_by_form">
          @csrf
          <div class="form-group row align-items-end">
            <div class="col-md-4">
              <label for="prepared_by">Prepared by</label>
              <input id="prepared_by" name="prepared_by" type="text" class="form-control" value="{{ $prepby ? $prepby->fullname : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="prepared_by_position">Position</label>
              <input id="prepared_by_position" name="prepared_by_position" type="text" class="form-control" value="{{ $prepby ? $prepby->position : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="prepared_by_signature">Signature <i>(.png file only)</i></label>
              <input id="prepared_by_signature" name="prepared_by_signature" type="file" class="form-control" value="{{ $prepby ? $prepby->position : ''  }}">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form enctype="multipart/form-data" id="recommending_approval_form">
          @csrf
          <div class="form-group row align-items-end">
            <div class="col-md-4">
              <label for="recommending_approval">Recommending Approval</label>
              <input id="recommending_approval" name="recommending_approval" type="text" class="form-control" value=" {{ $rec_approval ? $rec_approval->fullname : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="recommending_approval_position">Position</label>
              <input id="recommending_approval_position" name="recommending_approval_position" type="text" class="form-control" value="{{ $rec_approval ? $rec_approval->position : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="recommending_approval_signature">Signature <i>(.png file only)</i></label>
              <input id="recommending_approval_signature" name="recommending_approval_signature" type="file" class="form-control" value="{{ $rec_approval ? $rec_approval->position : ''  }}">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form enctype="multipart/form-data" id="approved_form">
          @csrf
          <div class="form-group row align-items-end">
            <div class="col-md-4">
              <label for="approved">Approved</label>
              <input id="approved" name="approved" type="text" class="form-control" value="{{ $approved ? $approved->fullname : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="approved_position">Position</label>
              <input id="approved_position" name="approved_position" type="text" class="form-control" value="{{ $approved ? $approved->position : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="approved_signature">Signature <i>(.png file only)</i></label>
              <input id="approved_signature" name="approved_signature" type="file" class="form-control" value="{{ $approved ? $approved->position : ''  }}">
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label> <!-- Keeps height consistent -->
              <input type="submit" class="btn btn-primary btn-block" value="Update">
            </div>
          </div>
        </form>

        <form enctype="multipart/form-data" id="conforme_form">
          @csrf
          <div class="form-group row align-items-end">
            <div class="col-md-4">
              <label for="conforme">Conforme</label>
              <input id="conforme" name="conforme" type="text" class="form-control" value="{{ $conforme ? $conforme->fullname : ''  }}">
            </div>
            <div class="col-md-3">
              <label for="conforme_position">Position</label>
              <input id="conforme_position" name="conforme_position" type="text" class="form-control" value="{{ $conforme ? $conforme->position : '' }}">
            </div>
            <div class="col-md-3">
              <label for="conforme_signature">Signature <i>(.png file only)</i></label>
              <input id="conforme_signature" name="conforme_signature" type="file" class="form-control" value="{{ $conforme ? $conforme->position : ''  }}">
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
  // Generic form handler
  function handleFormSubmit(formId, url) {
    $(formId).on('submit', function(e) {
      e.preventDefault();

      let formData = new FormData(this); // include text + file + _token

      $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,  // important for FormData
        contentType: false,  // important for FormData
        success: function(response) {
          alert('Updated successfully!');
        },
        error: function(xhr, status, error) {
          console.error('Error updating:', error);
        }
      });
    });
  }

  // Attach handlers
  handleFormSubmit('#prepared_by_form', '/ajax/admin/reports/update_preparedby');
  handleFormSubmit('#recommending_approval_form', '/ajax/admin/reports/update_recommendingapproval');
  handleFormSubmit('#approved_form', '/ajax/admin/reports/update_approved');
  handleFormSubmit('#conforme_form', '/ajax/admin/reports/update_conforme');
</script>
