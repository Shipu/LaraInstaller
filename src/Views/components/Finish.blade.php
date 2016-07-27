<template id="finish">
    <fieldset>
        <div class="finished">
            Congratulation, Completed Installation Process !!!
        </div>
        <button @click="nextorprevious('database')" class="previous action-button"> Previous </button>
        {{--<a href="{{ url('/') }}" >--}}
            <button @click="nextorprevious('finish')" class="next action-button"> Finished </button>
        {{--</a>--}}
        {{--<input type="button" @click="nextorprevious('finish')"  class="next action-button" value="Next" />--}}
    </fieldset>
</template>