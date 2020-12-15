<div class="modal fade modal-info" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalId}}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="{{$modalId}}Title">{{$title}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if($infos ?? false)
                        @foreach($infos as $title=>$info)
                            @if(! is_array($info))
                                <div class="col-lg-6 col-12 info-line">
                                    <p class="card-text my-1">
                                        <b>{{__($target.'.attributes.'.$title)}}</b>
                                        @if (filter_var($info, FILTER_VALIDATE_URL))
                                            <a href="{{$info}}" class="float-right" data-toggle="tooltip" data-placement="top" title="{{$info}}">{{Str::limit($info,40,'...')}}</a>
                                        @elseif(filter_var($info, FILTER_VALIDATE_EMAIL))
                                            <a href="mailto:{{$info}}" class="float-right" data-toggle="tooltip" data-placement="top" title="{{$info}}">{{Str::limit($info,40,'...')}}</a>
                                        @else 
                                            <span class="float-right" data-toggle="tooltip" data-placement="top" title="{{$info}}">
                                            @if(Str::contains($title,['amount', 'Amount']))
                                                {{ number_format($info, 2, ',', ' ') }} €
                                            @else 
                                                {{Str::limit($info,40,'...')}}
                                            @endif
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>