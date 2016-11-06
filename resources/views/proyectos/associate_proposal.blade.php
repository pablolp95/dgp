@extends("create")

@section("title")
    Asociar un presupuesto al proyecto #{{ $id }}
@endsection

@section("resource_title")
    Asociar un presupuesto al proyecto #{{ $id }}
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => ["proyecto.add.proposal", $id]]) !!}
            <!-- ID del presupuesto field -->
    <div class="input-field col s12">
        {!! Form::text("proposal_id", null, ["id" => "proposal_id","class" => "validate"]) !!}
        {!! Form::label("proposal_id", "ID del presupuesto:") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Asociar", ["type" => "submit", "class" => "btn waves-effect waves-light indigo right"]) !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        initProyectAssociateProposalValidation();
    </script>
@endsection