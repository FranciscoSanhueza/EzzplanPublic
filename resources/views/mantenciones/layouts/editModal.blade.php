<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_editModal">Modificacion de Mantenciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" id="editForm" method="POST" action="{{ Route('mantenciones.update' , '') }}">
                    @method('PUT')
                    <input type="hidden" name="_tokenE" id="_tokenE" value="{{ csrf_token() }}">
                    <input type="hidden" name="_id" id="_id" value="">
                    <div class="card">
                        <div class="card-header">
                            Informacion Principal
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="titleE" class="col-md-2 col-form-label text-md-right">Titulo</label>
                                <div class="col-md-9">
                                    <input type="titleE" class="form-control @error('titleE') is-invalid @enderror"
                                        id="titleE" name="titleE" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descE" class="col-md-2 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('descE') is-invalid @enderror" id="descE"
                                        name="descE" rows="3" required> </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="responsableE"
                                    class="col-md-2 col-form-label text-md-right">Responsable</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="responsableE">
                                        {{$responsableOption}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prioridadE" class="col-md-2 col-form-label text-md-right">Prioridad</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="prioridadE">
                                        <option value="{{ __('1') }}">{{ __('Baja') }}</option>
                                        <option value="{{ __('2') }}">{{ __('Media') }}</option>
                                        <option value="{{ __('3') }}">{{ __('Alta') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startE" class="col-md-2 col-form-label text-md-right">Inicio</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control @error('startE') is-invalid @enderror"
                                        id="startE" name="startE" required>
                                </div>
                                <label for="startHE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <input type="time" class="form-control @error('startHE') is-invalid @enderror"
                                        id="startHE" name="startHE" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="endE" class="col-md-2 col-form-label text-md-right">Final</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control @error('endE') is-invalid @enderror" id="endE"
                                        name="endE" required>
                                </div>
                                <label for="endHE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <input type="time" class="form-control @error('endHE') is-invalid @enderror"
                                        id="endHE" name="endHE" required>
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
                                <label for="previusFasesE" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusFasesE" name="previusFasesE">
                                        {{$fasesOption}}
                                    </select>
                                </div>

                                <label for="nextFasesE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextFasesE" name="nextFasesE">

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
                                <label for="previusEquiposE" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusEquiposE" name="previusEquiposE">
                                        {{$equiposOption}}
                                    </select>
                                </div>

                                <label for="nextEquiposE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextEquiposE" name="nextEquiposE">

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
                                <label for="previusTrabajadoresE" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusTrabajadoresE" name="previusTrabajadoresE">
                                        {{$trabajadoresOption}}
                                    </select>
                                </div>

                                <label for="nextTrabajadoresE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextTrabajadoresE" name="nextTrabajadoresE">

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
                                <label for="previusInsumosE" class="col-md-2 col-form-label text-md-right">Existentes</label>
                                <div class="col-md-4">
                                    <select class="custom-select" size="6" id="previusInsumosE" name="previusInsumosE">
                                        {{$insumosOption}}
                                    </select>
                                </div>

                                <label for="nextInsumosE" class="col-md-1 col-form-label text-md-right">-></label>
                                <div class="col-md-4">
                                    <select class="custom-select" multiple size="6" id="nextInsumosE" name="nextInsumosE">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br />
            </div>
            <div class="modal-footer" id="footer_insertModal">
                <button type="button" class="btn btn-success" id="edit_btn">Modificar</button>
                <button type="button" class="btn btn-danger" id="delete_btn">Eliminar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
