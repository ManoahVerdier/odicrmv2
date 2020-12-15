<div class="card m-3">
  <div class="card-header">
    <div class="text-center w-100">
      <i class="fas {{$icon}} fa-5x"></i>
    </div>
    <h4 class='card-title w-100 text-center mt-3'>{{$title}}</h4>
  </div>
  
    
    @if($main_infos ?? false)
      <div class="card-body">
        <div class="text-center">
          @foreach($main_infos as $info)
            @if ($loop->first)
              <p class="card-text mb-1"><b>{{$info}}</b></p>
            @else
              <p class="card-text mb-1">{{$info}}</p>
            @endif
          @endforeach
        </div>
      </div>
    @endif

    <div class="@if($main_infos??false) card-footer @else card-body @endif">
      @if($infos ?? false)
        @foreach($infos as $title=>$info)
          <p class="card-text mb-2">
            <b>{{__($target.'.attributes.'.$title)}}</b>
            @if (filter_var($info, FILTER_VALIDATE_URL))
              <a href="{{$info}}" class="float-right" data-toggle="tooltip" data-placement="top" title="{{$info}}">{{Str::limit($info,40,'...')}}</a>
            @elseif(filter_var($info, FILTER_VALIDATE_EMAIL))
              <a href="mailto:{{$info}}" class="float-right" data-toggle="tooltip" data-placement="top" title="{{$info}}">{{Str::limit($info,40,'...')}}</a>
            @else
              <span class="float-right">
                @if(Str::contains($title,['amount', 'Amount']))
                  {{ number_format($info, 2, ',', ' ') }} €
                @else 
                  {{Str::limit($info,40,'...')}}
                @endif
              </span>
            @endif
          </p>
        @endforeach
      @endif
      
      @if($showMore ?? false)
        <button class="btn btn-dark btn-block" data-toggle="modal" data-target="#{{$idModal}}">Voir tout</button>
      @endif
    </div>
    
</div>