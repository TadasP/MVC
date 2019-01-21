<form id="contact-form" method="post" action="/2lvl/Tadas/Model-view-controler/index.php/posts/oldStore" role="form">
  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label for="form_name">Title *</label>
              <input id="form_name" type="text" name="title" class="form-control" placeholder="Please enter your title*" required="required">
          </div>
      </div>
      <div class="col-md-6"> 
          <div class="form-group">
              <label for="form_name">Author *</label>
              <input id="form_name" type="text" name="author" class="form-control" placeholder="Please enter your nane*" required="required">
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
          <div class="form-group">
              <label for="form_message">Content *</label>
              <textarea id="form_message" name="content" class="form-control" placeholder="Content *" rows="4" required="required"></textarea>
          </div>
      </div>
      <div class="col-md-12">
          <input type="submit" name="insert-post" class="btn btn-success btn-send" value="Insert Post">
      </div>
  </div>
</form>