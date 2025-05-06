{{-- Mostra o icone do usuário e o respectivo card ao clicar --}}
<?php
$user_detail_id = 'user-detail-' . Str::random(5);
?>

<a class="btn btn-sm btn-light text-primary py-0" data-toggle="collapse" href="#{{ $user_detail_id }}" role="button"
  aria-expanded="false" aria-controls="collapseExample">
  <i class="fas fa-user"></i>
</a>

<div class="collapse" id="{{ $user_detail_id }}">
  <div class="card card-body">
    <span class="text-dark">
      <div>
        {{ $user->codpes }} - {{ $user->name }}
      </div>
      <div>
        Setor: {{ $user->setores()->wherePivot('funcao', '!=', 'Gerente')->first()->sigla ?? 'sem setor' }} -
        {{ $user->setores()->wherePivot('funcao', '!=', 'Gerente')->first()->pivot->funcao ?? '' }}
      </div>
      <div>
        <i class="fas fa-envelope-square mr-2"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
      </div>
      <div>
        <i class="fas fa-phone mr-2"></i> {{ $user->telefone ?? 'não disponível' }}
      </div>
      @if (config('solicitacoes-documentos.sistemaPessoas'))
        <div>
          <a href="{{ config('solicitacoes-documentos.sistemaPessoas') }}/pessoas/{{ $user->codpes }}" target="_PESSOAS">
            Ver mais em Pessoas <i class="fas fa-share"></i>
          </a>
        </div>
      @endif
    </span>
  </div>
</div>
