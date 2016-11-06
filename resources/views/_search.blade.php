{!! Form::open(['route'=> $search_route]) !!}
<div class="input-field">
    <input class="index-search-bar indigo white-text" id="search" name="search" type="search" required placeholder="{{ $searchbox_text }}">
    <label for="search"><i class="material-icons white-text">search</i></label>
    <i class="material-icons white-text">close</i>
</div>
{!! Form::close() !!}