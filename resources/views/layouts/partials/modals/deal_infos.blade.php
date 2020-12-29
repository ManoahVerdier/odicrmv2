<div class="modal fade modal-deal-info" id="dealInfo" tabindex="-1" role="dialog" aria-labelledby="dealInfo" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            {{-- Modal Header --}}
            <div class="modal-header">
                <h4 class="modal-title" id="dealInfoTitle">{{$title}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">

                {{-- Main infos --}}
                <div class="row text-center py-2" id="main-infos">

                    {{-- Amount --}}
                    <div class="col-md-4 align-self-center">
                        <p class="h1"><span id="amount" class="counter">0 </span><span class="text-info"> €</span></p>
                    </div>

                    {{-- Estim date --}}
                    <div class="col-md-4 align-self-center">
                        <div class=" d-inline-block position-relative mb-1 mt-1">
                            <i class="fas fa-calendar-day fa-3x "></i>
                        </div>
                        <p class="h3 mb-0" id="estim_date"></p>
                        <small>{{__("deals.attributes.estim_date")}}</small>
                    </div>

                    {{-- Step --}}
                    <div class="col-md-4 align-self-center">
                        <div class="icon d-inline-block position-relative mb-1 mt-1">
                            <div class="icon-circle"></div>
                            <div class="icon-wrap"  id="step-icon"><i class="fas fa-4x fa-question-circle"></i></div>
                        </div>
                        <div class="step-text" id="step-text">
                            Envoyé
                        </div>
                    </div>
                </div>

                {{-- Probability --}}
                <div class="row py-3" id="probability">
                    <div class="col-md-12 align-self-center">
                        <div id="step-bar" class="w-100 mb-2"><div class="progress-label"></div></div>
                    </div>
                </div>

                {{-- Details --}}
                <div class="row" id="detail">
                    @if($infos ?? false)
                        @foreach($infos as $title=>$info)
                            @if(! is_array($info))
                                <div class="col-lg-6 col-12 info-line">
                                    <p class="card-text my-1">
                                        <b>{{__($target.'.attributes.'.$info)}}</b>
                                        @if (filter_var($info, FILTER_VALIDATE_URL))
                                            <a href="" class="float-right" data-toggle="tooltip" data-placement="top" name="{{$info}}"></a>
                                        @elseif(filter_var($info, FILTER_VALIDATE_EMAIL))
                                            <a href="mailto:" class="float-right" data-toggle="tooltip" data-placement="top" name="{{$info}}"></a>
                                        @else 
                                            <span class="float-right" data-toggle="tooltip" data-placement="top" name="{{$info}}">
                                                @if(Str::contains($info,['amount', 'Amount']))
                                                     €
                                                @else 
                                                    
                                                @endif
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                
                {{-- More/notes --}}
                <div class="row">
                    <div class="col-12 info-line">
                        <div class="w-100"><b>{{__('deals.attributes.more')}}</b></div>
                        <p name="more" id="more"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>