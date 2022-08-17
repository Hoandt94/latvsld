<ul>
    @foreach($questions as $question)
    <li class="wtree-item">
        <span class="wtree-item-text">
            <label class="m-checkbox">
                <input type="checkbox" name="questions" value="{{$question->id}}"> {{$question->code}} - {{$question->content}}
                <span></span>
            </label>
        </span>
    </li>
    @endforeach
</ul>