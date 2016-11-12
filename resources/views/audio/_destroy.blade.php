<div class="row">
    <div class="col s12">
        <h3>Eliminar audio #{{ $audio->id }}</h3>
    </div>
    <div class="col s12">
        {!! Form::open(["method" => "delete", "route" => ["audio.destroy", $audio->id]]) !!}
        {!! Form::button("Eliminar", ["type" => "submit", "class" => "btn waves-effect waves-light left red"]) !!}
        {!! Form::close() !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
