{{-- Mostra o conteúdo de um setor --}}
<div>
  <a name="{{ \Str::lower($setor->sigla) }}" class="font-weight-bold">{{$setor->sigla}} - {{$setor->nome}}</a>
  @can('perfiladmin')
    @include('setores.partials.edit-modal')
    @include('setores.partials.add-modal')
    @include('setores.partials.btn-delete')
  @endcan
  <span class="badge badge-primary">{{ count($setor->users) }} pessoas</span>
  @include('setores.partials.detalhes')
</div>
