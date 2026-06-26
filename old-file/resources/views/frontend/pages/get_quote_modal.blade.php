<!-- QUERY-MODAL STARTS -->
    <div class="modal fade" id="Query{{ $iq }}">
    <div class="modal-dialog modal-dialog-centered" id="Query">
      <div class="modal-content">
        <div class="modal-header text-center">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <h4 class="modal-title text-center">Product Query</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div class="container">
            <form action="#" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-12 py-2">
                  <label for="name">Name:</label>
                  <input type="text" name="name" required="true" class="form-control">
                  @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <label for="name">E-mail:</label>
                  <input type="email" name="email" class="form-control" required="true">
                  @if($errors->has('email'))
                      <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif        
                </div>
                <div class="col-12 py-2">
                  <label for="name">Phone Number:</label>
                  <input type="text" class="form-control" required="true">
                  @if($errors->has('phone'))
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <label for="name">Product Name:</label>
                  <input type="text" name="product_name" value="" readonly="true" class="form-control">
                  @if($errors->has('product_name'))
                    <span class="text-danger">{{$errors->first('product_name')}}</span>
                  @endif
                  <input type="hidden" name="product_id" value="">
                </div>
                <div class="col-12 py-2">
                  <label for="name">Message:</label>
                  <textarea rowspan="5" name="query" id="message" class="form-control" required="true"></textarea>
                  @if($errors->has('query'))
                    <span class="text-danger">{{$errors->first('query')}}</span>
                  @endif
                </div>
                <div class="form-group">
              <input type="file" name="file" id="file">
                                          </div>
                <div class="col-12 py-3">
                  <div class="button text-center">
                    <button class="text-center btn" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- QUERY-MODAL ENDS -->