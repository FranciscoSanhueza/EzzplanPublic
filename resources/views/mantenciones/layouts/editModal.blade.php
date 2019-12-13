<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="title_editModal">Modificacion de Mantenciones</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form class="form-group" method="POST" action="">
                            @csrf
                            @method('PUT')
                                <div class="form-group row">
                                    <label for="titleE" class="col-md-4 col-form-label text-md-right">Titulo</label>
                                    <div class="col-md-7">
                                        <input type="titleE" class="form-control @error('titleE') is-invalid @enderror" id="titleE" name="titleE" required >
                                        @error('titleE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                        <label for="descE" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                        <div class="col-md-7">
                                            <textarea class="form-control @error('descE') is-invalid @enderror" id="descE" name="descE" rows="3" required > </textarea>
                                        
                                        @error('descE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>    
                                </div>
    
                                <div class="form-group row">
                                    <label for="startE" class="col-md-4 col-form-label text-md-right">Inicio</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control @error('startE') is-invalid @enderror" id="startE" name="startE"  >
                                        @error('startE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

        

                                <div class="form-group row">
                                    <label for="startHE" class="col-md-4 col-form-label text-md-right">-></label>
                                    <div class="col-md-7">
                                        <input type="time" class="form-control @error('startHE') is-invalid @enderror" id="startHE" name="startHE"  >
                                        @error('startHE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                        <label for="endE" class="col-md-4 col-form-label text-md-right">Final</label>
                                        <div class="col-md-7">
                                            <input type="date" class="form-control @error('endE') is-invalid @enderror" id="endE" name="endE"  required >
                                            @error('endE')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="endHE" class="col-md-4 col-form-label text-md-right">-></label>
                                        <div class="col-md-7">
                                            <input type="time" class="form-control @error('endHE') is-invalid @enderror" id="endHE" name="endHE"  >
                                            @error('endHE')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                
                            <br/>
            </div>
            <div class="modal-footer" id="footer_insertModal">
                    <button type="button" class="btn btn-success" id="edit_btn">Modificar</button>
                </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
    
          </div>
        </div>
    </div>