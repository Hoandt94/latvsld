<ul>
    @foreach($questions as $question)
    <li class="wtree-item">
        <span class="wtree-item-text">
            <label class="m-checkbox">
                <i class="flaticon-questions-circular-button"></i>
                <input type="checkbox" name="questions" value="{{$question->id}}"> {{$question->getCategory->getCode()}}.{{$question->order}} - {{$question->content}}
                <span></span>
            </label>
        </span>
    </li>
    @endforeach
</ul>