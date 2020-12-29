{{-- Title line --}}
<div class="col-12">
    <div class="text-center w-100">
        <i class="fas fa-file-invoice-dollar fa-5x"></i>
    </div>
    <h4 class='card-title w-100 text-center mt-3'>Devis</h4>
</div>

{{-- Section content --}}
<div class="col-12">
    <div class="row">

        {{-- Each deal --}}
        @foreach($client->deals as $deal)
            <div class="col-lg-6 col-12 mb-1">
                <div class="deal border rounded px-3 bg-white position-relative" deal_id={{$deal->id}}>
                    
                    {{-- Big icon --}}
                    <i class="fas {{$deal->step->icon}} position-absolute fa-4x status mt-1"></i>

                    {{-- First line : Title --}}
                    <div class="w-100 text-center">
                        <b>{{$deal->title}}</b>
                    </div>

                    {{-- Second line : amount, step, prob --}}
                    <div class="w-100 text-center">
                        <span class="px-3">
                            <i class="fas fa-euro-sign mr-2"></i>
                            {{ number_format($deal->amount, 2, ',', ' ') }} €
                        </span>
                        <span>
                            -
                        </span>
                        <span  class="px-3">
                            <i class="fas fa-tasks mr-2"></i>
                            {{$deal->step->name}}
                        </span>
                        <span>
                            -
                        </span>
                        <span class="px-3">
                            <i class="fas fa-percent mr-2"></i>
                            {{$deal->probability}}%
                        </span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>