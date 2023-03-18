@extends('layouts.app')

@section('title') Meu Perfil: - @endsection

@section('content')
    <div class="row my-5">
        <div class="col-12">
            <form action="{{ route('admin.profile.update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12">
                        <h3>Dados de Acesso</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nome Completo</label>
                    <input type="text" class="form-control @error('user.name') is-invalid @enderror" name="user[name]"
                           value="{{ $user->name }}"/>

                    @error('user.name')
                    <div class="invalid-feedback">
                        {{ $message  }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="text" class="form-control @error('user.email') is-invalid @enderror" name="user[email]"
                           value="{{ $user->email }}"/>

                    @error('user.email')
                    <div class="invalid-feedback">
                        {{ $message  }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" class="form-control @error('user.password') is-invalid
                           @enderror" name="user[password]"
                           placeholder="Ser você quiser atualizar sua senha preencha este campo e confirme abaixo"/>

                    @error('user.password')
                    <div class="invalid-feedback">
                        {{ $message  }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Confirmar Senha</label>
                    <input type="password" class="form-control" name="user[password_confirmation]"/>
                </div>


                @if($user->profile)
                    <div class="row">
                        <div class="col-12">
                            <h3>Dados de Perfil</h3>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Sobre</label>
                        <textarea name="profile[about]" id="" cols="80" rows="10">{{ $user->profile->about }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Contato</label>
                        <input type="text" class="form-control" name="profile[phone]"
                               value="{{ $user->profile->phone }}"/>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <h3>Redes Sociais</h3>
                            </div>
                        </div>
                        <hr>
                        @php $socialNetworks = $user->profile->social_networks; @endphp
                        {{--profile.social_networks.* || profile.social_networks.facebook...--}}

                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" name="profile[social_networks][facebook]"
                               value="{{ array_key_exists('facebook', $socialNetworks) ? $socialNetworks['facebook'] : null }}"
                               placeholder="Facebook"/>

                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control my-3" name="profile[social_networks][twitter]"
                               value="{{ array_key_exists('twitter', $socialNetworks) ? $socialNetworks['twitter'] : null }}"
                               placeholder="Twitter"/>

                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" name="profile[social_networks][instagram]"
                               value="{{ array_key_exists('instagram', $socialNetworks) ? $socialNetworks['instagram'] : null }}"
                               placeholder="Instagram"/>
                    </div>
                @endif

                <button class="btn btn-dark">Atualizar Perfil</button>

            </form>
        </div>
    </div>


@endsection
