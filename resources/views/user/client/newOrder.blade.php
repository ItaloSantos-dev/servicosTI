@extends('layout.main')
@section('title', 'New order')

@section('head')
@endsection

@section('content')
<main>
    @if($errors->any()||session()->has('info'))
        <div id="divErrors" class="flex flex-col justify-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-purple-300/20 backdrop-blur-2xl rounded-[20px] p-8 shadow-2xl max-w-2xl w-full z-50">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-purple-700">
                    @if($errors->any())
                        Erro
                    @else
                        Informação
                    @endif
                </h2>
                <button
                    onclick="hideOrderDetails('divErrors')"
                    class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors"
                >
                    Fechar
                </button>
            </div>

            <div class="flex flex-col gap-4">
                @if($errors->any())
                    @foreach($errors->all() as $erro)
                        <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <p class="text-base text-red-800 font-medium">{{$erro}}</p>
                        </div>
                    @endforeach
                @endif

                @if(session()->has('info'))
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                        <p class="text-base text-blue-800 font-medium">{{session('info')}}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="container mx-auto bg-white rounded-2xl p-3 shadow">
        <div class="max-w-6xl mx-auto p-8">
            <div class="bg-white rounded-[20px] p-8 shadow-lg border border-purple-200">
                <div class="text-center mb-8 flex justify-between">
                    <h1 class="font-bold text-purple-700 text-3xl">NOVO PEDIDO</h1>
                    <h1 id="valueOrder" class="font-semibold  text-2xl">Preço R$ 0</h1>
                </div>

                <form action="{{route('client.orders.store')}}" method="post">
                    @csrf
                    <div class="flex flex-col gap-6">
                        <div class="grid grid-cols-2 gap-4" >

                            <div class="flex flex-col gap-2">
                                <label for="type_id" class="text-sm font-bold text-center text-purple-600">SELECIONE O TIPO DO SERVIÇO</label>
                                <select
                                    onchange="ChangeValue(this.value)"
                                    name="type_id"
                                    id="type_id"
                                    class="text-center text-base text-gray-800 p-4 bg-purple-50 rounded-lg border border-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:text-purple-500 transition"
                                >
                                    <option>SELECIONE O TIPO QUE MAIS PARECE O SEU CASO</option>
                                    @foreach($orderTypes as $type)
                                        <div id="value{{$type->id}}" class="hidden ">{{$type->amount}}</div>
                                        <option id="o{{$type->id}}"  class="uppercase text-black" value="{{$type->id}}">{{mb_strtoupper($type->name, 'UTF-8')}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="discount_cupon" class="text-sm font-bold text-center text-purple-600">Cupom de desconto</label>
                                <input disabled onchange="VerifCupon(this.value)" type="text" name="discount_cupon" id="discount_cupon" class="text-center text-base text-gray-800 p-4 bg-purple-50 rounded-lg border border-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:text-purple-500 transition">

                                <input disabled class="hidden" type="text" name="discount_cupon_id" id="discount_cupon_id">
                                <div name="discount_amoun" id="discount_amoun"></div>
                            </div>
                            @foreach($discountCupons as $discountCupon)
                                <div id="valueCupon{{$discountCupon->id}}"
                                     data-cuponId="{{$discountCupon->id}}"
                                     data-cuponSlug="{{$discountCupon->slug}}"
                                     data-cuponMinimumAmount="{{$discountCupon->minimum_amount}}"
                                     data-cuponDiscountAmount="{{$discountCupon->amount}}"
                                     class="hidden minimumAmountCupon">
                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="description" class="text-center text-sm font-bold text-purple-600">Descreva o serviço</label>
                            <textarea
                                wrap="hard"
                                class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg border border-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none"
                                rows="4"
                                name="description"
                                id="description"
                            ></textarea>
                        </div>

                        <div class="flex flex-col gap-2 justi">
                            <label for="address" class="text-center text-sm font-bold text-purple-600">Digite o endereço</label>
                            <textarea
                                wrap="hard"
                                class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg border border-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none"
                                rows="4"
                                name="address"
                                id="address"
                            ></textarea>
                        </div>





                        <div class="flex justify-center items-center gap-4 mt-4">
                            <button
                                class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-[20px] shadow-lg hover:bg-purple-700 transition-colors"
                                type="button"
                                onclick="showOrderDetails('order-overlay')"
                            >
                                Confirmar
                            </button>

                            <a class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-[20px] shadow-lg hover:bg-gray-600 transition-colors"
                                type="button"
                                href="/orders"
                            >
                                Cancelar
                            </a>
                        </div>
                    </div>

                    <div id="order-overlay" class="fixed hidden inset-0 bg-black/50 bg-opacity-60 backdrop-blur-md z-50  items-center justify-center p-4">
                        <div class="bg-white rounded-[20px] p-8 shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                            <div class="flex justify-center"><h1 class="text-2xl font-bold">CONFIRME SUA SENHA</h1></div>

                            <div class="text-center flex flex-col gap-3 p-3">
                                <div class="flex justify-center">
                                    <input type="password" name='password' id='password' class='border shadow rounded p-2 w-90' />
                                    <div class=" p-1 flex justify-center">
                                        <button type="button" id="exibirSenha" onclick="ExibirSenha()" class="fa-solid fa-eye"></button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-center gap-5">
                                <button
                                    class="px-6 py-3 bg-purple-600 text-white font-semibold cursor-pointer rounded-[20px] shadow-lg hover:bg-green-700 transition-colors"
                                    type="submit"
                                >
                                    Confirmar
                                </button>
                                <button class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-[20px] shadow-lg hover:bg-red-600 transition-colors"
                                    onclick="hideOrderDetails('order-overlay')"
                                    type="button"
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@section('scripts')
<script>
    const cuponMap = new Map();

    //montar map com slug:[minimum_amount,id]
    for (const cupon of document.getElementsByClassName('minimumAmountCupon')){
        cuponMap.set(cupon.dataset.cuponslug, [parseFloat(cupon.dataset.cuponminimumamount), cupon.dataset.cuponid, parseFloat(cupon.dataset.cupondiscountamount)]);
    }
    console.log(cuponMap);


    function VerifCupon(slug){
        if(valueOrder===0){
            document.getElementById('discount_cupon').disabled=true;
        }
        const cupon = cuponMap.get(slug);

        if(cupon){
            if(valueOrder>0 && valueOrder>=cupon[0]){
                document.getElementById('discount_cupon_id').value=cupon[1];
                document.getElementById('discount_amoun').textContent=cupon[2] + "% de desconto";
                document.getElementById('valueOrder'). innerText = "Preço R$ " + (valueOrder - (cupon[2]/100)) ;
            }
            else{
                document.getElementById('discount_amoun').textContent="Cupom para compras a partir de  R$" + cupon[0];
            }
        }
        else{
            document.getElementById('discount_amoun').textContent="Cupom inválido";
        }

    }


    var valueOrder =0;



    function ChangeValue(id){
        document.getElementById('valueOrder'). innerText = "Preço R$ " + document.getElementById('value'+id).textContent;
        valueOrder = parseFloat(document.getElementById('value'+id).textContent);
        if(valueOrder===0){
            document.getElementById('discount_cupon').disabled=true;
        }
        else{
            document.getElementById('discount_cupon').disabled=false;
        }
    }

    function ExibirSenha() {
        var senhaInput = document.getElementById("password");
        var exibirSenhaBtn = document.getElementById("exibirSenha");

        if (senhaInput.type === "password") {
            senhaInput.type = "text";
            exibirSenhaBtn.classList.remove("fa-eye");
            exibirSenhaBtn.classList.add("fa-eye-slash");
        } else {
            senhaInput.type = "password";
            exibirSenhaBtn.classList.remove("fa-eye-slash");
            exibirSenhaBtn.classList.add("fa-eye");
        }
    }



    function showOrderDetails(divId) {
        const overlay = document.getElementById(divId);
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function hideOrderDetails(divId) {
        const overlay = document.getElementById(divId);
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    document.getElementById('order-overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            hideOrderDetails('order-overlay');
        }
    });


</script>
@endsection
@endsection
