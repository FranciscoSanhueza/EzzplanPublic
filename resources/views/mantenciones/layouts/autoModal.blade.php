<!-- Modal -->
<div class="modal fade" id="autoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                    <div class="card">
                        <div class="card-header">
                            Informacion Principal
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">Titulo</label>
                                <div class="col-md-9">
                                    <input type="title" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" required>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="desc" class="col-md-2 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('desc') is-invalid @enderror" id="desc"
                                        name="desc" rows="3" required> </textarea>
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="responsable" class="col-md-2 col-form-label text-md-right">Responsable</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="responsable">
                                        {{$responsableOption}}
                                    </select>
                                    @error('responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                            </div>

                            <div class="form-group row">
                                <label for="prioridad" class="col-md-2 col-form-label text-md-right">Prioridad</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="prioridad">
                                        <option value="{{ __('1') }}">{{ __('Baja') }}</option>
                                        <option value="{{ __('2') }}">{{ __('Media') }}</option>
                                        <option value="{{ __('3') }}">{{ __('Alta') }}</option>
                                    </select>
                                    @error('prioridad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                            </div>

                            <div class="form-group row">
                                <label for="start" class="col-md-2 col-form-label text-md-right">Inicio</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control @error('start') is-invalid @enderror"
                                        id="start" name="start" required>
                                    @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for="startH" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <input type="time" class="form-control @error('startH') is-invalid @enderror"
                                        id="startH" name="startH" required>
                                    @error('startH')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="cantidad" class="col-md-2 col-form-label text-md-right">Ciclo</label>
                                <div class="col-md-9">
                                    <input type="cantidad" class="form-control @error('cantidad') is-invalid @enderror"
                                        id="cantidad" name="cantidad" required>
                                    @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="cicloT" class="col-md-2 col-form-label text-md-right">Vez al</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="cicloT">
                                        <option value="{{ __('1') }}">{{ __('Año') }}</option>
                                        <option value="{{ __('2') }}">{{ __('Mes') }}</option>
                                        <option value="{{ __('3') }}">{{ __('Semana') }}</option>
                                    </select>
                                    @error('cicloT')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                            </div>

                            <div class="form-group row">
                                <label for="end" class="col-md-2 col-form-label text-md-right">Final</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control @error('end') is-invalid @enderror" id="end"
                                        name="end" required>
                                    @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="endH" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <input type="time" class="form-control @error('endH') is-invalid @enderror"
                                        id="endH" name="endH" required>
                                    @error('endH')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Informacion de fases
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="previusFases" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusFases" name="previusFases">
                                        {{$fasesOption}}
                                    </select>
                                </div>

                                <label for="nextFases" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextFases" name="nextFases">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Informacion de Equipos
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="previusEquipos" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusEquipos" name="previusEquipos">
                                        {{$equiposOption}}
                                    </select>
                                </div>

                                <label for="nextEquipos" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextEquipos" name="nextEquipos">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Informacion de Trabajadores
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="previusTrabajadores" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusTrabajadores" name="previusTrabajadores">
                                        {{$trabajadoresOption}}
                                    </select>
                                </div>

                                <label for="nextTrabajadores" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextTrabajadores" name="nextTrabajadores">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Informacion de Insumos
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="previusInsumos" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusInsumos" name="previusInsumos">
                                        {{$insumosOption}}
                                    </select>
                                </div>

                                <label for="nextInsumos" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextInsumos" name="nextInsumos">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <br />
            </div>
            <div class="modal-footer" id="footer_insertModal">
                <button type="button" class="btn btn-success" id="btn_insert">Agregar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>