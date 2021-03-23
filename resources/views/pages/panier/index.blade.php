@extends('layouts.app')

@section('content')
    <section style="    width: 82%;
    margin-left: 10%;">
        <form action="{{ url('save_panier') }}" method="POST">
        @csrf

        <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-lg-8">

                    <!-- Card -->
                    <div class="mb-3">
                        <div class="pt-4 wish-list">

                            <h5 class="mb-4"><span>{{count($pizzas)}}</span> pizzas</h5>
                            @foreach ($pizzas as $pizza)
                                <div class="row mb-4">
                                    <div class="col-md-5 col-lg-3 col-xl-3">
                                        <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                            <img style="    height: 140px;" class="img-fluid w-100"
                                                 src="{{ asset('/uploads/images/'.$pizza->url)}}"
                                                 alt="Sample">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-9 col-xl-9">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5>{{$pizza->nom}}</h5>
                                                    <p class="mb-3 text-muted text-uppercase small"></p>
                                                    <p class="mb-2 text-muted text-uppercase small"></p>
                                                </div>
                                                <div>
                                                    <div style="display: flow-root;"
                                                         class="def-number-input number-input safari_only mb-0 w-100">
                                                        <div class="row">
                                                            <button
                                                                type="button"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                                class="btn btn-primary minus"> -
                                                            </button>
                                                            <input readonly required style="width: 35%;"
                                                                   class="form-control qte" min="0"
                                                                   name="qte[]" value="0"
                                                                   type="number">
                                                            <input required hidden style="width: 35%;" class="price"
                                                                   min="0"
                                                                   name="prix" value="{{$pizza->prix}}"
                                                                   type="text">
                                                            <input hidden style="width: 35%;" class="price" min="0"
                                                                   name="id_pizza[]" value="{{$pizza->id}}"
                                                                   type="text">
                                                            <button
                                                                type="button"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                                class="btn btn-info plus">
                                                                +
                                                            </button>
                                                            <button style="margin-left: 6%;" type="button"

                                                                    class="btn btn-danger remove_item"><i
                                                                    class="fas fa-trash mr-1"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">
                                                    <span><strong>${{$pizza->prix}}</strong></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Card -->
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4">

                    <!-- Card -->
                    <div class="mb-3">
                        <div class="pt-4" style="margin-top: 9%;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total</strong>
                                    </div>
                                    <span><strong class="total">0</strong>€</span>
                                </li>
                            </ul>
                            <input hidden required style="width: 35%;" id="total" min="0"
                                   name="total"
                                   type="text">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>

                        </div>
                    </div>
                    <!-- Card -->

                </div>
                <!--Grid column-->

            </div>
            <!-- Grid row -->
            {!! $pizzas->links() !!}
        </form>
    </section>

    <script>
        $(document).ready(function () {
            $('.plus').on('click', function () {
                let amount = parseFloat(this.parentNode.querySelector('input[type=text]').value).toFixed(2);
                let total = parseFloat($('.total').text());
                $('#total').val(parseFloat(parseFloat(total) + parseFloat(amount)).toFixed(2));
                $('.total').text(parseFloat(parseFloat(total) + parseFloat(amount)).toFixed(2));
            });
            $('.minus').on('click', function () {
                let amount = parseFloat(this.parentNode.querySelector('input[type=text]').value).toFixed(2);
                let total = parseFloat($('.total').text());
                $('#total').val(parseFloat(parseFloat(total) - parseFloat(amount)).toFixed(2));
                $('.total').text(parseFloat(parseFloat(total) - parseFloat(amount)).toFixed(2));
            });
            $('.remove_item').on('click', function () {
                if (this.parentNode.querySelector('input[type=number]').value > 0) {
                    let amount = parseFloat(this.parentNode.querySelector('input[type=text]').value).toFixed(2);
                    let qte = parseInt(this.parentNode.querySelector('input[type=number]').value);
                    let total = parseFloat($('.total').text());
                    $('#total').val(parseFloat(parseFloat(total) - (parseFloat(amount) * parseInt(qte))).toFixed(2));
                    $('.total').text(parseFloat(parseFloat(total) - (parseFloat(amount) * parseInt(qte))).toFixed(2));
                    this.parentNode.querySelector('input[type=number]').stepDown(this.parentNode.querySelector('input[type=number]').value);
                }
            });
        })
    </script>
@endsection
