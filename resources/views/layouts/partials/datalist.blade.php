<table 
        id="{{$name}}-table" 
        class="table table-bordered table-hover datalist" 
        style="width:100%" 
        datasource="{{route($name.'.datasource')}}" 
        createurl="{{route($name.'.create')}}" 
        column_filtering="{{$column_filtering ?? false}}"
        mass_edit="{{$mass_edit ?? false}}"
        excel_export="{{$excel_export ?? false}}"
        pdf_export="{{$pdf_export ?? false}}"
        saved_queries="{{$saved_queries ?? false}}"
        name="{{$name}}"
    >
    <thead class="thead-dark">
        <tr>
            @foreach($columnsNames as $columnName)
                <th class="" column-name="{{$columnName}}" real-column="1">{{__($name.".attributes.$columnName")}}</th>
            @endforeach
        </tr>
        @if($column_filtering ?? false)
            <tr class="d-none d-md-table-row">
                @foreach($columnsNames as $columnName)
                    <th class="" column-name="{{$columnName}}" >{{__($name.".attributes.$columnName")}}</th>
                @endforeach
            </tr>
        @endif
    </thead>
    <tbody>
        
    </tbody>
    <tfoot class="thead-dark">
        @foreach($columnsNames as $columnName)
            <th>{{__($name.".attributes.$columnName")}}</th>
        @endforeach
    </tfoot>
</table>

@if($mass_edit ?? false)
    @include(
        "layouts.partials.modals.mass_edit",
        [
            "columnsNames"=>$columnsNames,
            "name"=>$name
        ]
    )
@endif

@if($saved_queries ?? false)
    @include(
        "layouts.partials.modals.saved_queries",
        [
            "name"=>$name
        ]
    )
@endif