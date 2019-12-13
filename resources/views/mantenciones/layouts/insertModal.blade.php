<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="title_insertModal">Registro de Mantenciones</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="insForm" class="form-group" method="POST" action="{{ Route('mantenciones.store') }}">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Titulo</label>
                            <div class="col-md-7">
                                <input type="title" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required >
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="desc" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-7">
                                    <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required > </textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>    
                        </div>

                        <div class="form-group row">
                            <label for="start" class="col-md-4 col-form-label text-md-right">Inicio</label>
                            <div class="col-md-7">
                                <input type="date" class="form-control @error('start') is-invalid @enderror" id="start" name="start" required >
                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="startH" class="col-md-4 col-form-label text-md-right">-></label>
                            <div class="col-md-7">
                                <input type="time" class="form-control @error('startH') is-invalid @enderror" id="startH" name="startH"  required >
                                @error('startH')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="end" class="col-md-4 col-form-label text-md-right">Final</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control @error('end') is-invalid @enderror" id="end" name="end"  required >
                                    @error('end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="endH" class="col-md-4 col-form-label text-md-right">-></label>
                                <div class="col-md-7">
                                    <input type="time" class="form-control @error('endH') is-invalid @enderror" id="endH" name="endH"  required>
                                    @error('endH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </form>
                    <br/>
        </div>
        <div class="modal-footer" id="footer_insertModal">
                <button type="button" class="btn btn-success" id="btn_insert">Agregar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
</div>