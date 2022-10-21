<x-app-layout>
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" /> <!-- 'classic' theme -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12" style="padding-bottom: 0px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 15px;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route("clients.store") }}" id="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Nome">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}"
                                       placeholder="CPF">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg') }}"
                                       placeholder="RG">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth">Data de Nascimento</label>
                                <input type="text" class="form-control" id="birth" name="birth" value="{{ old('birth') }}"
                                       placeholder="Data de Nascimento">
                            </div>
                        </div>
                        <hr style="margin: 20px 0px;">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9" onblur="pesquisacep(this.value);"  value="{{ old('cep') }}"
                                       placeholder="CEP">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="street">Rua</label>
                                <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}"
                                       placeholder="Rua">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="number">Número</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}"
                                       placeholder="Número">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="district">Bairro</label>
                                <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}"
                                       placeholder="Bairro">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}"
                                       placeholder="Cidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}"
                                       placeholder="Estado">
                            </div>
                        </div>
                        <hr style="margin: 20px 0px;">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="imageUrl">Foto</label>
                                <input type="file" class="form-control" id="imageUrl" name="imageUrl"
                                       placeholder="Foto">
                            </div>
                        </div>
                        <hr style="margin: 20px 0px;">
                        <div class="col-lg-12" style="margin-top: 15px;">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Criar</button>
                                <a href="{{ route("clients") }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $.fn.datepicker.dates['en'] = {
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                daysShort: ["Dom", "Mon", "Tue", "Wed", "Thu", "Sex", "Sab"],
                daysMin: ["Do", "Se", "Te", "Qu", "Qi", "Se", "Sa"],
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                today: "Hoje",
                clear: "Limpar",
                format: "dd-mm-yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };

            $('#birth').datepicker({
                language: 'pt-BR',
                format: 'dd-mm-yyyy'
            });


        });

        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('street').value=("");
            document.getElementById('district').value=("");
            document.getElementById('city').value=("");
            document.getElementById('state').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('street').value=(conteudo.logradouro);
                document.getElementById('district').value=(conteudo.bairro);
                document.getElementById('city').value=(conteudo.localidade);
                document.getElementById('state').value=(conteudo.uf);
                document.getElementById('number').focus();
            } //end if.
                else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('street').value="...";
                    document.getElementById('district').value="...";
                    document.getElementById('city').value="...";
                    document.getElementById('state').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                    else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
                else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    </script>
</x-app-layout>
