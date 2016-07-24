<template id="permission">
    <fieldset>
        <h2 class="fs-title">Permissions</h2>
        <h3 class="fs-subtitle">Check for folder permissions</h3>
        <ul class="permission">
            <li class="{{ $permission[0] ? 'pass' : 'fail' }}">Storage/app/ <span class="pvalue">775</span></li>
            <li class="{{ $permission[1] ? 'pass' : 'fail' }}">Storage/framework/ <span class="pvalue">775</span></li>
            <li class="{{ $permission[2] ? 'pass' : 'fail' }}">Storage/logs/ <span class="pvalue">775</span></li>
            <li class="{{ $permission[3] ? 'pass' : 'fail' }}">Bootstrap/cache/ <span class="pvalue">775</span></li>
        </ul>
        <button @click="nextorprevious('extension')" class="previous action-button"> Previous </button>
        <button @click="nextorprevious('database')" class="next action-button"> Next </button>
        {{--<input type="button" class="previous action-button" value="Previous" />--}}
        {{--<input type="submit" class="next action-button" value="Next" />--}}
    </fieldset>
</template>