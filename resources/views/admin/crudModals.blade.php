
<div class="modal fade createproduct" id="createproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role = "document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss = "modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                <div class="modal-title">
                </div>
            </div>
            <form action="{{ route('admin.create') }}" method="POST" id="createproductform" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">name</label>
                                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"  />
                                        <input type="text" class="form-control" name="name" id="name1">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea class="form-control" rows="5" name="description" id="description1"></textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="start_price">starting price</label>
                                        <input type="number" class="form-control" name="start_price" id="start_price1">
                                        <span class="text-danger error-text start_price_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="auction_ends">auction ends</label>
                                        <input type="datetime-local" class="form-control" name="auction_ends" id="auction_ends1">
                                        <span class="text-danger error-text auction_ends_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Image</h4>
                                            <input type="file" id="input-file-now" name="image" class="dropify" />
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-primary btn-sm add-file ml-3" type="submit">List new item for sale</button>
                                </div>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editproduct" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role = "document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss = "modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                <div class="modal-title">
                </div>
            </div>
            <form action="{{ route('admin.update') }}" method="PUT"  id="updateproductform">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="hidden" id="id" name="id" />
                                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />
                                        <input type="text" class="form-control" name="name" id="name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="start_price">starting price</label>
                                            <input type="number" class="form-control" name="start_price" id="start_price">
                                            <span class="text-danger error-text start_price_error"></span>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="auction_ends">auction ends</label>
                                        <input type="datetime" class="form-control" name="auction_ends" id="auction_ends">
                                        <span class="text-danger error-text auction_ends_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-primary btn-sm add-file ml-3" type="submit">Update product</button>
                                </div>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade deleteproduct" id="deleteproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role = "document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss = "modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                <div class="modal-title">
                </div>
            </div>
            <form action="/admin/productdelete" method="DELETE" id="deleteproductform">
                @csrf
                <input type="hidden" id="productid" value>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary btn-sm add-file ml-3" type="submit">Delete product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
