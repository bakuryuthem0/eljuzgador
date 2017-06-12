<div class="modal fade" id="elimThing">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Eliminar</h4>
      </div>
      <div class="modal-body">
        ¿Seguro desea realizar esta acción?, este cambio es irreversible.
        <div class="alert responseAjax">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p></p>
        </div>
      </div>
      <div class="modal-footer">
        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
        <button type="button" class="btn btn-danger btn-elim-thing-modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>