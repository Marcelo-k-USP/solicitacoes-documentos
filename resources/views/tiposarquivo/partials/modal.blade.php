<!-- Modal que atende adicionar e editar tipos de arquivo -->
<div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Adicionar/Editar Tipos de Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list_table_div_form">
          {{ html()->form('post', '')->open() }}
            @csrf
            @method('post')
            {{ html()->hidden('id') }}
            @php
              $modo = 'create';
              $ordenar_por_valor = true;
            @endphp
            @foreach ($fields as $col)
              @if (empty($col['type']) || $col['type'] == 'text')
                @include('common.list-table-form-text')
              @elseif ($col['type'] == 'select')
                @include('common.list-table-form-select')
              @endif
            @endforeach
            <div class="text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          {{ html()->form()->close() }}
        </div>
      </div>
    </div>
  </div>
</div>

@section('javascripts_bottom')
@parent
  <script type="text/javascript">
    $(document).ready(function() {

      $('#modalForm').on('shown.bs.modal', function() {
        $(this).find(':input[type=text]').filter(':visible:first').focus();
      });

      edit_form = function(id) {
        $.get('tiposarquivo/' + id
          , function(row) {
            console.log(row);
            // mudando para PUT
            $('#modalForm :input').filter("input[name='_method']").val('PUT');

            // preenchendo o form com os valores a serem editados
            var inputs = $("#modalForm :input").not(":input[type=button], :input[type=submit], :input[type=reset], input[name^='_']");
            inputs.each(function() {
              $(this).val(row[this.name]);
              console.log(this.name);
            });

            // Ajustando action
            $('#modalForm').find('form').attr('action', 'tiposarquivo/' + id);

            // Ajustando o title
            $('#modalLabel').html('Editar Tipo de Documento');

            $("#modalForm").modal();
            console.log('inputs', inputs);
          });
      };

      add_form = function(id) {
          $("#modalForm :input").filter("input[type='text']").val('');

          // preenchendo o form com os valores a serem editados
          $("#modalForm select").val(id);

          // Ajustando action
          $('#modalForm').find('form').attr('action', 'tiposarquivo');

          $('#modalLabel').html('Adicionar Tipo de Documento');
          $('#modalForm :input').filter("input[name='_method']").val('POST');

          $("#modalForm").modal();
      };
    });
  </script>
@endsection
